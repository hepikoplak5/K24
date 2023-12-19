# K24-TestKerja-PHPDeveloper

This is laravel 10 with complate login feature including spatie

## Installation
 
```bash
composer require spatie/laravel-permission
```

Optional
Check your service provider in config/app.php dir then add this code

```php
'providers' => [
    // ...
    Spatie\Permission\PermissionServiceProvider::class,
];
```

After installation, you need to publish the migration and the config/permission.php config file

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

Then make your seeder to test it, here the example

```php
public function run(): void
    {
        //premission name for assigned to each role
        //you need to define the permission first and then assign the permission to the role below
        $permissions = [
            'Admin',
            'User'
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }

        //this is the role
        //after you define each role with the permission, you can assign the role to each data user
        Role::create(['name' => 'Admin'])->givePermissionTo('Admin');
        Role::create(['name' => 'User'])->givePermissionTo('User');

        User::create([
            'name' => 'Admin', 
            'username' => 'Admin', 
            'nohp' => '6281358820785', 
            'tgl_lahir' => Carbon::create('2000', '01', '01'), 
            'noktp' => '3517090512010003', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Admin'); //this is how to assign

        User::create([
            'name' => 'User', 
            'username' => 'User', 
            'nohp' => '6281358820785', 
            'tgl_lahir' => Carbon::create('2001', '01', '01'), 
            'noktp' => '3517092405980003', 
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('User');
    }
```

Then run the migration

```bash
php artisan migrate --seed
```

After migration process done, try the blade feature
You can use @can, @cannot, @canany, and @guest to test for permission-related access

example :
```
		@can('Admin')
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data User</h5>

              <!-- Table with stripped rows -->
              <table class="table" id="example">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">No. KTP</th>
                    <th scope="col">No. HP</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
        </div>
        @endcan
```