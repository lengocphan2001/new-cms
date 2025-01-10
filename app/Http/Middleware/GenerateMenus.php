<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('admin_sidebar', function ($menu) {
            /**
             * Dashboard
             */ 
            $menu->add('<i class="nav-icon fa-solid fa-cubes"></i> '.__('Dashboard'), [
                'route' => 'backend.dashboard',
                'class' => 'nav-item',
            ])->data([
                'order' => 1,
                'activematches' => 'admin/dashboard*',
            ])->link->attr([
                'class' => 'nav-link',
            ]);


            /**
             * Separator: Access Management
             */ 
            // $menu->add(__('Management'), [
            //     'class' => 'nav-title',
            // ])->data([
            //     'order' => 50,
            //     'permission' => ['edit_settings', 'view_backups', 'view_users', 'view_roles', 'view_logs'],
            // ]);

            /**
             * Settings
             */ 
            $menu->add('<i class="nav-icon fas fa-cogs"></i> '.__('Settings'), [
                'route' => 'backend.settings',
                'class' => 'nav-item',
            ])->data([
                'order' => 70,
                'activematches' => 'admin/settings*',
                'permission' => ['edit_settings'],
            ])->link->attr([
                'class' => 'nav-link',
            ]);

            /**
             * Access Control
             */ 
            $accessControl = $menu->add('<i class="nav-icon fa-solid fa-user-gear"></i> '.__('Access Control'), [
                'class' => 'nav-group',
            ])->data([
                'order' => 80,
                'activematches' => [
                    'admin/users*',
                    'admin/roles*',
                ],
                'permission' => ['view_users', 'view_roles'],
            ]);
            $accessControl->link->attr([
                'class' => 'nav-link nav-group-toggle',
                'href' => '#',
            ]);
            // Submenu: Users
            $accessControl->add('<i class="nav-icon fa-solid fa-user-group"></i> '.__('Users'), [
                'route' => 'backend.users.index',
                'class' => 'nav-item',
            ])->data([
                'order' => 81,
                'activematches' => 'admin/users*',
                'permission' => ['view_users'],
            ])->link->attr([
                'class' => 'nav-link',
            ]);
            // Submenu: Roles
            $accessControl->add('<i class="nav-icon fa-solid fa-user-shield"></i> '.__('Roles'), [
                'route' => 'backend.roles.index',
                'class' => 'nav-item',
            ])->data([
                'order' => 82,
                'activematches' => 'admin/roles*',
                'permission' => ['view_roles'],
            ])->link->attr([
                'class' => 'nav-link',
            ]);

            /**
             * Notifications
             */ 
            $menu->add('<i class="nav-icon fas fa-bell"></i> '.__('Notifications'), [
                'route' => 'backend.notifications.index',
                'class' => 'nav-item',
            ])->data([
                'order' => 90,
                'activematches' => 'admin/notifications*',
                'permission' => [],
            ])->link->attr([
                'class' => 'nav-link',
            ]);

            /**
             * Backup
             */ 
            $menu->add('<i class="nav-icon fas fa-archive"></i> '.__('Backups'), [
                'route' => 'backend.backups.index',
                'class' => 'nav-item',
            ])->data([
                'order' => 100,
                'activematches' => 'admin/backups*',
                'permission' => ['view_backups'],
            ])->link->attr([
                'class' => 'nav-link',
            ]);

            /**
             * Log Viewer
             */ 
            $accessControl = $menu->add('<i class="nav-icon fa-solid fa-list-check"></i> '.__('Log Viewer'), [
                'class' => 'nav-group',
            ])->data([
                'order' => 110,
                'activematches' => [
                    'log-viewer*',
                ],
                'permission' => ['view_logs'],
            ]);
            $accessControl->link->attr([
                'class' => 'nav-link nav-group-toggle',
                'href' => '#',
            ]);
            // Submenu: Log Viewer Dashboard
            $accessControl->add('<i class="nav-icon fa-solid fa-list"></i> '.__('Logs dashboard'), [
                'route' => 'log-viewer::dashboard',
                'class' => 'nav-item',
            ])->data([
                'order' => 111,
                'activematches' => 'admin/log-viewer',
            ])->link->attr([
                'class' => 'nav-link',
            ]);
            // Submenu: Log Viewer Logs by Days
            $accessControl->add('<i class="nav-icon fa-solid fa-list-ol"></i> '.__('Logs by Days'), [
                'route' => 'log-viewer::logs.list',
                'class' => 'nav-item',
            ])->data([
                'order' => 112,
                'activematches' => 'admin/log-viewer/logs*',
            ])->link->attr([
                'class' => 'nav-link',
            ]);

            /**
             * Access Permission Check
             */
            $menu->filter(function ($item) {
                if ($item->data('permission')) {
                    if (auth()->check()) {
                        if (auth()->user()->hasRole('super admin')) {
                            return true;
                        }
                        if (auth()->user()->hasAnyPermission($item->data('permission'))) {
                            return true;
                        }
                    }

                    return false;
                }

                return true;
            });

            /**
             * Set Active Menu
             */
            $menu->filter(function ($item) {
                if ($item->activematches) {
                    $activematches = is_string($item->activematches) ? [$item->activematches] : $item->activematches;
                    foreach ($activematches as $pattern) {
                        if (request()->is($pattern)) {
                            $item->active();
                            $item->link->active();
                            if ($item->hasParent()) {
                                $item->parent()->active();
                            }
                        }
                    }
                }

                return true;
            });
        })->sortBy('order');

        return $next($request);
    }
}