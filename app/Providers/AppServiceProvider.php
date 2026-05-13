<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    public function register() {}

    public function boot()
    {
        // Helper @imgurl untuk tampilkan gambar dari Cloudinary atau Storage lokal
        Blade::directive('imgurl', function ($expression) {
            return "<?php 
                \$_imgPath = {$expression};
                echo (\$_imgPath && str_starts_with(\$_imgPath, 'http')) 
                    ? \$_imgPath 
                    : (\$_imgPath ? \Illuminate\Support\Facades\Storage::url(\$_imgPath) : '');
            ?>";
        });
    }
}