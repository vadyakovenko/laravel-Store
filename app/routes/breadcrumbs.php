<?php

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;
use App\Entity\Category;
use App\Entity\Provider\Provider;

Breadcrumbs::for('dashboard', function (Crumbs $crumbs) {
    $crumbs->push('<i class="fa fa-dashboard"></i> Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('admin.categories.index', function(Crumbs $crumbs) {
    $crumbs->parent('dashboard');
    $crumbs->push('Categories', route('admin.categories.index'));
});

Breadcrumbs::for('admin.categories.create', function(Crumbs $crumbs) {
    $crumbs->parent('admin.categories.index');
    $crumbs->push('Create', route('admin.categories.create'));
});

Breadcrumbs::for('admin.categories.show', function(Crumbs $crumbs, Category $category) {
    if ($parent = $category->parent) {
        $crumbs->parent('admin.categories.show', $parent);
    } else {
        $crumbs->parent('admin.categories.index');
    }
    $crumbs->push($category->name, route('admin.categories.show', $category));
});

Breadcrumbs::for('admin.categories.edit', function(Crumbs $crumbs, Category $category) {
    $crumbs->parent('admin.categories.show', $category);
    $crumbs->push('Edit', route('admin.categories.edit', $category));
});



Breadcrumbs::for('admin.providers.index', function(Crumbs $crumbs) {
    $crumbs->parent('dashboard');
    $crumbs->push('Providers', route('admin.providers.index'));
});

Breadcrumbs::for('admin.providers.create', function(Crumbs $crumbs) {
    $crumbs->parent('admin.providers.index');
    $crumbs->push('Create', route('admin.providers.create'));
});

Breadcrumbs::for('admin.providers.show', function(Crumbs $crumbs, Provider $provider) {
    $crumbs->parent('admin.providers.index');
    $crumbs->push($provider->name, route('admin.providers.index'));
});

Breadcrumbs::for('admin.providers.edit', function(Crumbs $crumbs, Provider $provider) {
    $crumbs->parent('admin.providers.show', $provider);
    $crumbs->push('Edit', route('admin.providers.edit', $provider));
});

Breadcrumbs::for('admin.users.index', function(Crumbs $crumbs) {
    $crumbs->parent('dashboard');
    $crumbs->push('Users', route('admin.users.index'));
});