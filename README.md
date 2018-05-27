# hasil-seleksi

hasil-seleksi


# Passing Grade

[![Join the chat at https://gitter.im/hasil-seleksi/Lobby](https://badges.gitter.im/hasil-seleksi/Lobby.svg)](https://gitter.im/hasil-seleksi/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bantenprov/hasil-seleksi/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/hasil-seleksi/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/bantenprov/hasil-seleksi/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/hasil-seleksi/build-status/master)
[![Latest Stable Version](https://poser.pugx.org/bantenprov/hasil-seleksi/v/stable)](https://packagist.org/packages/bantenprov/hasil-seleksi)
[![Total Downloads](https://poser.pugx.org/bantenprov/hasil-seleksi/downloads)](https://packagist.org/packages/bantenprov/hasil-seleksi)
[![Latest Unstable Version](https://poser.pugx.org/bantenprov/hasil-seleksi/v/unstable)](https://packagist.org/packages/bantenprov/hasil-seleksi)
[![License](https://poser.pugx.org/bantenprov/hasil-seleksi/license)](https://packagist.org/packages/bantenprov/hasil-seleksi)
[![Monthly Downloads](https://poser.pugx.org/bantenprov/hasil-seleksi/d/monthly)](https://packagist.org/packages/bantenprov/hasil-seleksi)
[![Daily Downloads](https://poser.pugx.org/bantenprov/hasil-seleksi/d/daily)](https://packagist.org/packages/bantenprov/hasil-seleksi)

Passing Grade

### Install via composer

- Development snapshot

```bash
composer require bantenprov/hasil-seleksi:dev-master
```

- Latest release:

```bash
composer require bantenprov/hasil-seleksi
```

### Download via github

```bash
git clone https://github.com/bantenprov/hasil-seleksi.git
```

#### Edit `config/app.php` :

```php
'providers' => [
    /*
    * Laravel Framework Service Providers...
    */
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Broadcasting\BroadcastServiceProvider::class,
    Illuminate\Bus\BusServiceProvider::class,
    Illuminate\Cache\CacheServiceProvider::class,
    Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
    Illuminate\Cookie\CookieServiceProvider::class,
    //...
    Bantenprov\HasilSeleksi\HasilSeleksiServiceProvider::class,
    //...
];
```

#### Edit `app/Http/Kernel.php`

```php
protected $routeMiddleware = [
    'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    //...
    'role' => \Laratrust\Middleware\LaratrustRole::class,
    'permission' => \Laratrust\Middleware\LaratrustPermission::class,
    'ability' => \Laratrust\Middleware\LaratrustAbility::class,
    //...
];
```

#### Lakukan publish semua komponen :

```bash
php artisan vendor:publish --tag=hasil-seleksi-publish
```

#### Lakukan auto dump :

```bash
composer dump-autoload
```

#### Lakukan seeding :

```bash
```

#### Edit menu `resources/assets/js/menu.js`

```javascript
{
    name: 'Dashboard',
    icon: 'fa fa-dashboard',
    childType: 'collapse',
    childItem: [
        //...
        // Passing Grade (Public)
        {
            name: 'Passing Grade (Public)',
            link: '/hasil-seleksi-public',
            icon: 'fa fa-angle-double-right',
        },
        // Passing Grade
        {
            name: 'Passing Grade',
            link: '/dashboard/hasil-seleksi',
            icon: 'fa fa-angle-double-right',
        },
        //...
    ]
},
```

```javascript
{
    name: 'Admin',
    icon: 'fa fa-lock',
    childType: 'collapse',
    childItem: [
        //...
        // Passing Grade
        {
            name: 'Passing Grade',
            link: '/admin/hasil-seleksi',
            icon: 'fa fa-angle-double-right',
        },
        //...
    ]
},
```

#### Tambahkan components `resources/assets/js/components.js` :

```javascript
//... Passing Grade ...//
```
#### Tambahkan route di dalam file : `resources/assets/js/routes.js` :

```javascript
{
    path: '/dashboard',
    redirect: '/dashboard/home',
    component: layout('Default'),
    children: [
        //...
        // Passing Grade (Public)
        {
            path: '/hasil-seleksi-public',
            components: {
                main: resolve => require(['~/components/bantenprov/hasil-seleksi/hasil-seleksi-public/HasilSeleksiPublic.index.vue'], resolve),
                navbar: resolve => require(['~/components/Navbar.vue'], resolve),
                sidebar: resolve => require(['~/components/Sidebar.vue'], resolve),
            },
            meta: {
                title: "Passing Grade",
            },
        },
        {
            path: '/hasil-seleksi-public/:id/:track?',
            components: {
                main: resolve => require(['~/components/bantenprov/hasil-seleksi/hasil-seleksi-public/HasilSeleksiPublic.show.vue'], resolve),
                navbar: resolve => require(['~/components/Navbar.vue'], resolve),
                sidebar: resolve => require(['~/components/Sidebar.vue'], resolve),
            },
            meta: {
                title: "View Passing Grade",
            },
        },
        //...
        // Passing Grade
        {
            path: '/dashboard/hasil-seleksi',
            components: {
                main: resolve => require(['~/components/views/bantenprov/hasil-seleksi/hasil-seleksi/HasilSeleksiDashboard.vue'], resolve),
                navbar: resolve => require(['~/components/Navbar.vue'], resolve),
                sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "Passing Grade",
            },
        },
        //...
    ]
},
```

```javascript
{
    path: '/admin',
    redirect: '/admin/dashboard/home',
    component: layout('Default'),
    children: [
        //...
        // Passing Grade
        {
            path: '/admin/hasil-seleksi',
            components: {
                main: resolve => require(['~/components/bantenprov/hasil-seleksi/hasil-seleksi/HasilSeleksi.index.vue'], resolve),
                navbar: resolve => require(['~/components/Navbar.vue'], resolve),
                sidebar: resolve => require(['~/components/Sidebar.vue'], resolve),
            },
            meta: {
                title: "Passing Grade",
            },
        },
        {
            path: '/admin/hasil-seleksi/:id/:track?',
            components: {
                main: resolve => require(['~/components/bantenprov/hasil-seleksi/hasil-seleksi/HasilSeleksi.show.vue'], resolve),
                navbar: resolve => require(['~/components/Navbar.vue'], resolve),
                sidebar: resolve => require(['~/components/Sidebar.vue'], resolve),
            },
            meta: {
                title: "View Passing Grade",
            },
        },
        //...
    ]
},
```
