<?php /** @noinspection ForgottenDebugOutputInspection */

declare(strict_types=1);

namespace App\Http\Controllers\ApiV1;

use App\Http\Requests\TweetRequest;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use LogicException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Twitter;

class TwitterController
{

    public function tweet(): Renderable
    {
        return view('v1.tweet');
    }

    /**
     * @throws Exception
     */
    public function postTweet(TweetRequest $request): Response
    {
        $file = $request->file(TweetRequest::FIELD_IMAGE);
        $text = $request->get(TweetRequest::FIELD_TEXT);
        $mediaUploadType = $request->get(TweetRequest::FIELD_MEDIA_UPLOAD_TYPE);

        switch ($mediaUploadType) {
            case TweetRequest::MEDIA_UPLOAD_TYPE_CHUNKED:
                $mediaId = $this->doChunkedUpload($file);
                break;
            case TweetRequest::MEDIA_UPLOAD_TYPE_BASE_64:
                $mediaId = $this->doRawUpload($file);
                break;
            case TweetRequest::MEDIA_UPLOAD_TYPE_SIMPLE:
            default:
                $mediaId = $this->doSimpleUpload($file);
        }

        $postResponse = Twitter::postTweet(
            [
                'status' => $text,
                'media_ids' => $mediaId,
            ]
        );

        /** @noinspection ForgottenDebugOutputInspection */
        dd($postResponse);
    }

    /**
     * @param UploadedFile $file
     *
     * @return string
     * @throws FileException
     */
    private function doSimpleUpload(UploadedFile $file): string
    {
        $uploadResult = Twitter::uploadMedia(
            [
                'media' => $file->getContent(),
            ]
        );

        return $uploadResult->media_id_string;
    }

    /**
     * @param UploadedFile $file
     *
     * @return string
     */
    private function doRawUpload(UploadedFile $file): string
    {
        $uploadResult = Twitter::uploadMedia(
            [
                'media_data' => base64_encode(file_get_contents($file->path())),
            ]
        );

        return $uploadResult->media_id_string;
    }

    /**
     * Usually you would chunk a video but this demonstrates how chunking would work.
     *
     * After a media has been uploaded it can take Twitter some time to process it before it
     * can be used. At this point one would check the status of the upload to make sure it's
     * complete before proceeding.
     *
     * @see https://developer.twitter.com/en/docs/twitter-api/v1/media/upload-media/api-reference/get-media-upload-status
     * @throws LogicException
     */
    private function doChunkedUpload(UploadedFile $file): string
    {
        $initMedia = Twitter::uploadMedia(
            [
                'command' => 'INIT',
                'media_type' => $file->getMimeType(),
                'media_category' => 'tweet_image',
                'total_bytes' => $file->getSize(),
            ]
        );
        $mediaId = $initMedia->media_id_string;

        // Upload the first (or only) chunk
        // https://developer.twitter.com/en/docs/media/upload-media/uploading-media/chunked-media-upload
        $uploadedMedia = Twitter::uploadMedia(
            [
                'media' => $file,
                'command' => 'APPEND',
                'segment_index' => '0',
                'media_id' => $mediaId,
            ]
        );

        // Finalize the media upload
        $finalMedia = Twitter::uploadMedia(
            [
                'command' => 'FINALIZE',
                'media_id' => $mediaId,
            ]
        );

        // check status periodically here

        return $mediaId;
    }

    public function getTweet()
    {
        $tweets = Twitter::getUserTimeline(['screen_name' => 'IAmReliq', 'count' => 5]);

        dd($tweets);
    }
}
