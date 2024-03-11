<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;

class CustomeBladeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Blade::directive('FieldError', function($fieldname) {
            return "<?php if(\$errors->has($fieldname)): ?>
                       <span class=\"text-danger\"><?php echo e(\$errors->first($fieldname)); ?></span>
                    <?php endif; ?>";
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
