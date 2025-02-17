<?php

namespace TFSThiagoBR98\FilamentTenant;

use Filament\Notifications\Notification;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

trait SetsProfilePhotoFromUrl
{
    /**
     * Sets the users profile photo from a URL.
     */
    public function setProfilePhotoFromUrl(string $url): void
    {
        $name = pathinfo($url)['basename'];
        $response = Http::get($url);

        //Determine if the status code is >= 200 and < 300
        if ($response->successful()) {
            file_put_contents($file = sys_get_temp_dir() . '/' . Str::uuid()->toString(), $response);

            $this->updateProfilePhoto(new UploadedFile($file, $name));
        } else {
            Notification::make()
                ->title('Unable to retrieve image')
                ->danger()
                ->persistent()
                ->send();
        }
    }
}
