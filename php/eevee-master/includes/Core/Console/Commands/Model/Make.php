<?php

namespace Core\Console\Commands\Model;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class Make extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:model {model name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new model with template.';


    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('model name');

        config(['view.paths' => [__DIR__]]);

        $code = View::make('template', [
            'StartTag' => '<?php ',
            'ModelNamespacePath' => $this->generateModelNamespacePath($name),
            'ModelName' => $this->generateModelName($name),
            'ModelNameToLower' => $this->generareModelNameToLower($name),
        ]);

        $modelFileName = base_path('core/Models' . str_replace('\\', '/', $this->generateModelNamespacePath($name)) . '.php');


        if (Storage::has(ltrim($modelFileName, base_path()))) {
            $this->error('Model ' . $modelFileName . ' has exists');
        } else {

            Storage::put(ltrim($modelFileName, base_path()), $code);
            
            $this->info('Create model ' . $modelFileName . 'success.');
        }


    }


    protected function generateModelName($name)
    {
        $items = explode('/', $name);

        return ucfirst($items[count($items) - 1]);
    }

    protected function generareModelNameToLower($name)
    {
        return strtolower($this->generateModelName($name));
    }

    protected function generateModelNamespacePath($name)
    {
        $path = '\\';

        $items = explode('/', $name);

        foreach ($items as $item) {
            $path .= ucfirst($item) . '\\';
        }

        return rtrim($path, '\\');
    }

}
