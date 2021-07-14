<?php

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

						return sendError('File Extension is not supported.', null);
					}
				}
			}else{
				return sendError('Please provide files.', null);
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
				return sendError('File Extension is not supported.', null);
			}
		}

		return sendSuccess('Success.', $uploadedFiles);
	}
	?>