
## What's inside

- Adminpanel based on [CoreUI theme](https://coreui.io/): with default one admin user (_admin@admin.com/password_) and two roles
- Users/Roles/permissions management function (based on our own code similar to Spatie Roles-Permissions)
- One demo CRUD for Products management - name/description/price
- Everything that is needed for CRUDs: model+migration+controller+requests+views

## How to use

- Clone the repository with __git clone__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run __composer install__
- Run __php artisan key:generate__
- Run __php artisan migrate --seed__ (it has some seeded data for your testing)
- That's it: launch the main URL or go to __/login__ and login with default credentials __admin@admin.com__ - __password__

