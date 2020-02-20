# nejcc/prepare-tailwind prepare for laravel-ui

## Installation

#### 1. Laravel last version
```
composer create-project --prefer-dist laravel/laravel blog
```
#### 2. Laravel ui scaffolding
```
composer require laravel/ui
```
```
composer require nejcc/prepare-tailwind
```
```
php artisan ui:auth
```
#### 3. Tailwind prepare (when you run this command will replace your UI folder!!)
##### For Tailwind Only
```
php artisan ui tailwind
```

##### For Tailwind and Vue
```
php artisan ui tailwind-vue
```

##### For Tailwind, Vue, and Auth Views
```
php artisan ui tailwind-vue-auth
```

#### 4. Compile

```
npm install
```
and / or
```
npm run watch
```

#### 5. serve

```
php artisan serve
```
or
```
php artisan serve --port 8888
```
