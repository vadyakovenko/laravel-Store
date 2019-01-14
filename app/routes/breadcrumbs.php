<?php

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;
use App\Entity\Store\Category;
use App\Entity\Store\Provider\Provider;
use App\Entity\Store\Tag;
use App\Entity\Store\Product\Product;


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

Breadcrumbs::for('admin.products.index', function(Crumbs $crumbs) {
    $crumbs->parent('dashboard');
    $crumbs->push('Products', route('admin.products.index'));
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
    $crumbs->push($provider->name, route('admin.providers.show', $provider));
});

Breadcrumbs::for('admin.providers.edit', function(Crumbs $crumbs, Provider $provider) {
    $crumbs->parent('admin.providers.show', $provider);
    $crumbs->push('Edit', route('admin.providers.edit', $provider));
});

Breadcrumbs::for('admin.tags.index', function(Crumbs $crumbs) {
    $crumbs->parent('dashboard');
    $crumbs->push('Tags', route('admin.tags.index'));
});

Breadcrumbs::for('admin.tags.create', function(Crumbs $crumbs) {
    $crumbs->parent('admin.tags.index');
    $crumbs->push('Create', route('admin.tags.create'));
});

Breadcrumbs::for('admin.tags.show', function(Crumbs $crumbs, Tag $tag) {
    $crumbs->parent('admin.tags.index');
    $crumbs->push($tag->name, route('admin.tags.index'));
});

Breadcrumbs::for('admin.tags.edit', function(Crumbs $crumbs, Tag $tag) {
    $crumbs->parent('admin.tags.show', $tag);
    $crumbs->push('Edit', route('admin.tags.edit', $tag));
});

Breadcrumbs::for('admin.users.index', function(Crumbs $crumbs) {
    $crumbs->parent('dashboard');
    $crumbs->push('Users', route('admin.users.index'));
});