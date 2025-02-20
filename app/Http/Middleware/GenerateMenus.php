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
             * Don hang
             */ 
            $accessControl = $menu->add('<i class="nav-icon fa-solid fa-user-gear"></i> '. 'Đơn hàng' , [
                'class' => 'nav-group',
            ])->data([
                'order' => 2,
                'activematches' => [
                    'admin/projects*',
                ],
                'permission' => ['view_projects'],
            ]);
            $accessControl->link->attr([
                'class' => 'nav-link nav-group-toggle',
                'href' => '#',
            ]);
            // Submenu: List
            $accessControl->add('<i class="nav-icon fa-solid fa-user-group"></i> '. 'Danh sách đơn hàng', [
                'route' => 'backend.projects.index',
                'class' => 'nav-item',
            ])->data([
                'order' => 3,
                'activematches' => 'admin/projects*',
                'permission' => ['view_projects'],
            ])->link->attr([
                'class' => 'nav-link',
            ]);

            // Submenu: Add project
            $accessControl->add('<i class="nav-icon fa-solid fa-user-shield"></i> ' . 'Thêm đơn hàng', [
                'route' => 'backend.projects.create',
                'class' => 'nav-item',
            ])->data([
                'order' => 4,
                'activematches' => 'admin/projects*',
                'permission' => ['add_projects'],
            ])->link->attr([
                'class' => 'nav-link',
            ]);


            // san pham
            $menu->add('<i class="nav-icon fas fa-cogs"></i> '. 'Sản phẩm', [
                'route' => 'backend.products.index',
                'class' => 'nav-item',
            ])->data([
                'order' => 5,
                'activematches' => 'admin/products*',
                'permission' => ['view_products'],
            ])->link->attr([
                'class' => 'nav-link',
            ]);


            // san pham
            $menu->add('<i class="nav-icon fas fa-cogs"></i> '. 'Gán công đoạn', [
                'route' => 'backend.employees.index',
                'class' => 'nav-item',
            ])->data([
                'order' => 5,
                'activematches' => 'admin/employees*',
                'permission' => ['view_employees'],
            ])->link->attr([
                'class' => 'nav-link',
            ]);
            

            // group
            $menu->add('<i class="nav-icon fas fa-cogs"></i> '. 'Tổ sản xuất', [
                'route' => 'backend.groups.index',
                'class' => 'nav-item',
            ])->data([
                'order' => 6,
                'activematches' => 'admin/groups*',
                'permission' => ['view_groups'],
            ])->link->attr([
                'class' => 'nav-link',
            ]);


            // cong doan
            $menu->add('<i class="nav-icon fas fa-cogs"></i> '. 'Công đoạn', [
                'route' => 'backend.stages.index',
                'class' => 'nav-item',
            ])->data([
                'order' => 7,
                'activematches' => 'admin/stages*',
                'permission' => ['view_stages'],
            ])->link->attr([
                'class' => 'nav-link',
            ]);


            // nhom cong doan
            $menu->add('<i class="nav-icon fas fa-cogs"></i> '. 'Nhóm công đoạn', [
                'route' => 'backend.stage_groups.index',
                'class' => 'nav-item',
            ])->data([
                'order' => 8,
                'activematches' => 'admin/stage_groups*',
                'permission' => ['view_stage_groups'],
            ])->link->attr([
                'class' => 'nav-link',
            ]);


            // thong ke luong
            $menu->add('<i class="nav-icon fas fa-cogs"></i> '. 'Thống kê lương', [
                'route' => 'backend.salaries.index',
                'class' => 'nav-item',
            ])->data([
                'order' => 9,
                'activematches' => 'admin/salaries*',
                'permission' => ['view_salaries'],
            ])->link->attr([
                'class' => 'nav-link',
            ]);


            // san luong
            $menu->add('<i class="nav-icon fas fa-cogs"></i> '. 'Sản lượng', [
                'route' => 'backend.stage_users.index',
                'class' => 'nav-item',
            ])->data([
                'order' => 9,
                'activematches' => 'admin/stage_products*',
                'permission' => ['view_stage_users'],
            ])->link->attr([
                'class' => 'nav-link',
            ]);

            /**
             * Settings
             */ 
            $menu->add('<i class="nav-icon fas fa-cogs"></i> '.__('Settings'), [
                'route' => 'backend.settings',
                'class' => 'nav-item',
            ])->data([
                'order' => 200,
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