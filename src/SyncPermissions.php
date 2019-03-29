<?php
namespace MWI\LaravelPermissionsSync\Commands;

use DB;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use App\Services\RolesAndPermissions;
use Spatie\Permission\Models\Permission;

class SyncPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spatie:permissions:sync {--clean=false} {--verbosity=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Permissions and Roles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * logs to console if needed
     *
     * @return void
     * @author 
     **/
    public function log($message)
    {
        if (env('APP_ENV') === 'local' || $this->option('verbosity') > 0) {
            echo $message . PHP_EOL;
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->log('Starting Permissions Sync Process');

        $syncedRoles = [];
        foreach (RolesAndPermissions::structure() as $role => $permissions)
        {
            $this->log('syncing ' . $role . ' permissions');

            $roleModel = Role::firstOrCreate(['name' => $role]);

            $syncedPermissions = [];
            foreach ($permissions as $permission) {
                $permissionModel = Permission::firstOrCreate(['name' => $permission]);

                $roleModel->givePermissionTo($permissionModel);

                array_push($syncedPermissions, $permissionModel->id);
            }

            $roleModel->permissions()->sync($syncedPermissions);

            array_push($syncedRoles, $roleModel->id);
        }

        if ($this->option('clean') === true) {
            Role::whereNotIn('id', $syncedRoles)->delete();
        }

        app()['cache']->forget('spatie.permission.cache');

        $this->log('Finished Permissions Sync Successfully!');
    }
}
