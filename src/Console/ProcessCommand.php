<?php


namespace Iyngaran\RealEstate\Console;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Iyngaran\RealEstate\RealEstate;

class ProcessCommand extends Command
{
    protected $signature = "realestate:process";

    protected $description = "Import Real Estate";

    public function handle()
    {

        if (Category::configNotPublished()) {
            return $this->warn(
                'Please publish the config file by running '
                .'\'php artisan vendor:publish --tag=realestate-config\''
            );
        }

        try {
            $files = File::files('storage/app/Category/data');
            dd($files);
            // Validate the files

        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

    }

}