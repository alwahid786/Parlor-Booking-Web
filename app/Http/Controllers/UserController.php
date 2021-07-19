<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\Day;
use App\Models\Media;
use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class UserController extends Controller
{
	private $userService;
	
	public function __construct(UserService $userService)
	{
		$this->userService = $userService;
	}

    public function updateUser(Request $request){

    	$validator = Validator::make($request->all(), [
    		'user_uuid' => 'required|exists:users,uuid',
    		'address' => 'string',
    		'lat' => 'numeric|required_if:address,null',
    		'long' => 'numeric|required_if:address,null',
    		'start_time' => 'date_format:H:i',
    		'end_time' => 'date_format:H:i|after:start_time',
    		'description' => 'string',
            'media' => 'image'
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user = User::where('uuid', $request->user_uuid)->first();
        if(!$user)
            return sendError("user Not Found",[]);

        DB::beginTransaction();     
        try {
            $data_media = [];

	        if('user'== $user->type)
	        	$user->name = $request->name??$user->name;
	        else{

	        	$user->name = $request->name??$user->name;
	        	$user->address = $request->address??$user->address;
	        	$user->lat = $request->lat??$user->lat;
	        	$user->long = $request->long??$user->long;
	        	$user->start_time = $request->start_time??$user->start_time??'09:00';
	        	$user->end_time = $request->end_time??$user->end_time??'15:00';
	        	$user->description = $request->description??$user->description;
	        }
            if(isset($request->media)){
                $result = $this->uploadMedias($request);
                if(!$result['status'])
                    return sendError($result['message'] ,$result['data']);

                $medias_data = $result['data'];
                foreach($medias_data as $media_data){
                    $media = Media::where('user_id',$user->id)->first();
                    if(null == $media)
                        $media = new Media;

                    $media->user_id =  $user->id;
                    $media->uuid = str::uuid();
                    $media->name = $media_data['title'];
                    $media->filename = $media_data['filename']; 
                    $media->tag = $media_data['tag']; 
                    $media->path = $media_data['path']; 
                    $media->media_type = $media_data['type']; 
                    $media->media_ratio = $media_data['ratio']; 
                    $media->media_thumbnail   = $media_data['thumbnail'];
                    $data_media[] = $media;
                    if(!$media->save()){

                        DB::rollBack();
                        return sendError('Internal Server Error,Media not saved',[]);
                    }
                }
            }

	        $user->save();
	        if(!$user->save()){

	    		DB::rollBack();
	        	return sendError("Internal Server Error",[]);
	        }

            $daysSaved = [];
            if('salon'== $user->type){            
                if(isset($request->days)){
                    
                    $days = array_unique(json_decode($request->days));
                    $database_days =  Day::where('salon_id',$user->id)->pluck('day')->toArray();
                    $days_to_add = array_diff($days,$database_days);
                    $days_to_delete = array_diff($database_days,$days);
                    
                    foreach($days_to_delete as $day){
                        $day_to_delete = Day::where('salon_id',$user->id)->where('day',$day)->delete();
                    }    
                    foreach ($days_to_add as $day) {
                        $day_obj = new Day;
                        $day_obj->uuid = str::uuid();
                        $day_obj->salon_id = $user->id;
                        $day_obj->day = strtolower($day);
                        $day_obj->save();
                        $daysSaved[] = $day_obj->day;
                    }
                }
            }

        	DB::commit();
	        $data['user'] = $user;
            if(isset($request->days))
                $data['user']['days'] = $daysSaved;
            if(isset($request->media))
                $data['user']['media'] = $data_media;
            else{
                $data['user']['media'] = $user->media;
            }
            
        	return sendSuccess('User updated',$data);
        	
	    }
	    catch (Exception $e) {
	    	DB::rollBack();
	        return sendError($e->getMessage(), $e->getTrace());
	    }
    }

    public function deleteProfile(Request $request){

    	$validator = Validator::make($request->all(), [
    		'user_uuid' => 'required_without:profile_uuid|exists:users,uuid',
    		'profile_uuid' => 'required_without:user_uuid|exists:profiles,uuid',
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }


    	DB::beginTransaction(); 
    	try{
    		if(isset($request->profile_uuid)){

    			$profile = Profile::where('uuid',$request->profile_uuid)->where('type','salon')->first();

        		if(null == $profile)
        			return sendError('Profile not found',[]);

				$profile->delete();
    		}
    		if(isset($request->user_uuid)){

    			$user = User::where('uuid',$request->user_uuid)->first();
    			
        		if(null == $user)
        			return sendError('User not found',[]);

				$profile = Profile::where('user_id',$user->id)->delete();
				$user->delete();
    		}

    		DB::commit();
    		return sendSuccess('Deleted profile',[]);
    	}
    	catch (Exception $e){
    		DB::rollBack();
        	return sendError($e->getMessage(), $e->getTrace());
    	}
    }

    public function getUser(Request $request){
        $validator = Validator::make($request->all(), [
            'user_uuid' => 'exists:users,uuid',
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        } 

        $user = User::where('uuid',$request->user_uuid??$request->user()->id)
            ->with(['media','days'])->first();

        return sendSuccess('User Data',$user);
    }

    public function uploadMedias(Request $request, $fieldName = 'media', $nature = 'profile_image', $multiple = false){
        $uploadedFiles = [];
        if($multiple){
            if($request->hasFile($fieldName)){

                foreach ($request->file($fieldName) as $media) {
                    $file = $media;
                    $video_xtensions = ['flv', 'mp4', 'mpeg', 'mkv', 'avi'];
                    $image_xtensions = ['png', 'jpg', 'jpeg', 'gif', 'bmp, '];
                    $doc_xtensions = ['pdf'];
                    $allowedFilesExtensions = array_merge($video_xtensions, $image_xtensions, $doc_xtensions);

                    $file_extension = $file->getClientOriginalExtension();
                    if (in_array($file_extension, $allowedFilesExtensions)) {
                        $temp['title'] = $file->getClientOriginalName();
                        $temp['tag'] = $nature;
                        $temp['type'] = (in_array($file_extension, $doc_xtensions))? 'pdf' : 'image';

                        $targetName = $nature . rand(1000, 9999) . '.' . $file_extension;
                        $temp['filename'] = $targetName;

                        // upoad file on server
                        $file->move(getUploadDir($nature), $targetName);
                        $targetPath = getUploadDir($nature).$targetName;
                        $temp['path'] = $nature .'/'.$targetName;
                        
                        if (in_array($file_extension, $doc_xtensions)) {
                            $temp['ratio'] = 1;
                        }else{
                            $imageSize = getimagesize($targetPath);
                            $temp['ratio'] = $imageSize[0] / $imageSize[1];
                        }

                        // generate thumbnail
                        $thumbnailFilename = $nature.'_thumbnail_' . rand(10, 999999) . '.png';
                        // dd($targetPath);
                        // $contents = \FFMpeg::openUrl($targetPath)
                        // ->export()
                        // ->addFilter(function (VideoFilters $filters) {
                        // $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
                        // })
                        // // ->disk('local')
                        // // ->save(getUploadDir($nature, true), $thumbnailFilename);
                        // ->save($thumbnailFilename);
                        // $temp['thumbnail'] = getUploadDir($nature, true) . $thumbnailFilename;
                        $temp['thumbnail'] = $temp['path'];
                        $uploadedFiles[] = array_merge($uploadedFiles, $temp);
                    }else{

                        return internalError('File Extension is not supported.', null);
                    }
                }
            }else{
                return internalError('Please provide files.', null);
            }
        }else{
            $file = $request->file($fieldName);

            $video_xtensions = ['flv', 'mp4', 'mpeg', 'mkv', 'avi'];
            $image_xtensions = ['png', 'jpg', 'jpeg', 'gif'];
            $doc_xtensions = ['pdf'];
            $allowedFilesExtensions = array_merge($video_xtensions, $image_xtensions, $doc_xtensions);

            $file_extension = $file->getClientOriginalExtension();
        
            if (in_array($file_extension, $allowedFilesExtensions)) {
                $temp['title'] = $file->getClientOriginalName();
                $temp['tag'] = $nature;
                $temp['type'] = (in_array($file_extension, $doc_xtensions)) ? 'pdf' : 'image';

                $targetName = $nature . rand(1000, 9999) . '.' . $file_extension;
                $temp['filename'] = $targetName;

                // upoad file on server
                $file->move(getUploadDir($nature), $targetName);
                $targetPath = getUploadDir($nature) . $targetName;
                $temp['path'] = 'uploads/'. $nature . '/' . $targetName;
                if(false == getimagesize($targetPath)){
                    $temp['ratio'] = 1;
                }else{
                    $imageSize = getimagesize($targetPath);
                    $temp['ratio'] = $imageSize[0] / $imageSize[1];
                }

                // generate thumbnail
                $thumbnailFilename = $nature . '_thumbnail_' . rand(10, 999999) . '.png';
                // dd($targetPath);
                // $contents = \FFMpeg::openUrl($targetPath)
                // ->export()
                // ->addFilter(function (VideoFilters $filters) {
                // $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
                // })
                // // ->disk('local')
                // // ->save(getUploadDir($nature, true), $thumbnailFilename);
                // ->save($thumbnailFilename);
                // $temp['thumbnail'] = getUploadDir($nature, true) . $thumbnailFilename;
                $temp['thumbnail'] = $temp['path'];
                $uploadedFiles[] = array_merge($uploadedFiles, $temp);
            } else {
                return internalError('File Extension is not supported.', null);
            }
        }

        return internalSuccess('Success.', $uploadedFiles);
    }

}
