<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ admin_url('/') }}" class="brand-link">
      <img src="{{ asset('uploads/settings/'. settings()->logo) }}" alt="{{ settings()->site_name }}" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text fw-bold">{{ settings()->site_name }}</span>
    </a>
    <div class="sidebar">
     
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ admin_url('/') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p class="truncated-text">{{__('admin.dashboard')}}</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('messages.index') }}" class="nav-link {{ request()->is('admin/messages*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-envelope"></i>
              <p class="truncated-text">
                Messages
                <span class="badge badge-danger right" style="display: none;">0</span>
              </p>
            </a>
          </li>
          {{ config('is_ecommerce') }}
          @if(config('is_ecommerce')) 
          <li class="nav-item {{ request()->is('admin/product*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/product*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-copy"></i>
              <p class="truncated-text">
                {{__('admin.products')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ admin_url('product') }}" class="nav-link {{ request()->is('admin/product') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.list_products')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{admin_url('product/create')}}" class="nav-link {{ request()->is('admin/product/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.add_product')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('import_product')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('import_product')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('print_barcode') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.print_barcode/label')}}</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- end product --}}
          {{-- Books --}}
          <li class="nav-item {{ request()->is('admin/group_book*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/group_book*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p class="truncated-text">
                {{__('admin.books')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ admin_url('group_book/books') }}" class="nav-link {{ request()->is('admin/group_book/books') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.book_lists')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{admin_url('group_book/books/create')}}" class="nav-link {{ request()->is('admin/group_book/books/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.add_book')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('group_book/import') }}" class="nav-link {{ request()->is('admin/group_book/import') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.import_books')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('group_book/print_barcodes') }}" class="nav-link {{ request()->is('admin/group_book/print_barcodes') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.print_barcode/label')}}</p>
                </a>
              </li>
            </ul>
          </li>
  
          <li class="nav-item {{ request()->is('admin/borrowers*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/borrowers*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-copy"></i>
              <p class="truncated-text">
                {{__('admin.book_borrowing')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ admin_url('borrowers') }}" class="nav-link {{ request()->is('admin/borrowers') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.book_borrowing_list')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{admin_url('borrowers/create')}}" class="nav-link {{ request()->is('admin/borrowers/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{ __('admin.add_book_borrowing') }}</p>
                </a>
              </li>
            </ul>
          </li>
          
        <li class="nav-item {{ request()->is('admin/attendances*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is('admin/attendances*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p class="truncated-text">
              {{__('admin.attendences')}}
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ admin_url('attendances') }}" class="nav-link {{ request()->is('admin/attendances') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p class="truncated-text">{{__('admin.attendance_list')}}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{admin_url('attendances/create')}}" class="nav-link {{ request()->is('admin/attendances/create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p class="truncated-text">{{__('admin.add_attendance')}}</p>
              </a>
            </li>
          </ul>
        </li>
        {{-- end attendent--}}
          
          <li class="nav-item {{ request()->is('admin/peoples*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/peoples*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                {{__('admin.peoples')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ admin_url('peoples/users') }}" class="nav-link {{ request()->is('admin/peoples/users') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('admin.user_lists')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('peoples/users/create') }}" class="nav-link {{ request()->is('admin/peoples/users/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('admin.add_user')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('peoples/students') }}" class="nav-link {{ request()->is('admin/peoples/students') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('admin.student_lists')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('peoples/students/create') }}" class="nav-link {{ request()->is('admin/peoples/students/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('admin.add_student')}}</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ request()->is('admin/settings*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }} {{ request()->is('admin/roles*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                {{__('admin.settings')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ admin_url('settings') }}" class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('admin.system_settings')}}</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ admin_url('about-page') }}" class="nav-link {{ request()->is('admin/about-page*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">About Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('staff-members') }}" class="nav-link {{ request()->is('admin/staff-members*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">Staff & Librarians</p>
                </a>
              </li>
            
               <li class="nav-item">
                <a href="{{ admin_url('settings/detections') }}" class="nav-link {{ request()->is('admin/settings/detections') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.manage_login_devices')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('settings/categories') }}" class="nav-link {{ request()->is('admin/settings/categories') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.categories')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('settings/category_langauges') }}" class="nav-link {{ request()->is('admin/settings/category_langauges') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.category_languages')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('settings/provinces')}}" class="nav-link {{ request()->is('admin/settings/provinces') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.provinces')}}</p>
                </a>
              </li>

              @if(config('app.permission_group'))
              <li class="nav-item">
                <a href="{{ admin_url('settings/permission-groups')}}" class="nav-link {{ request()->is('admin/settings/permission-groups') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.permission-groups')}}</p>
                </a>
              </li>
              @endif

              <li class="nav-item">
                <a href="{{ admin_url('settings/permissions')}}" class="nav-link {{ request()->is('admin/settings/permissions') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.permissions')}}</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ admin_url('settings/roles') }}" class="nav-link {{ request()->is('admin/settigs/roles') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('admin.roles')}}</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item {{ request()->is('admin/reports*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p class="truncated-text">
                {{__('admin.report')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ admin_url('reports/daily_attendances') }}" class="nav-link {{ request()->is('admin/reports/daily_attendances') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.daily_attendance_report')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('reports/daily_borrowers') }}" class="nav-link {{ request()->is('admin/reports/daily_borrowers') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>  
                  <p class="truncated-text">{{__('admin.daily_borrower_report')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('reports/attendances') }}" class="nav-link {{ request()->is('admin/reports/attendances') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.attendance_report')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('reports/books') }}" class="nav-link {{ request()->is('admin/reports/books') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.books_report')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('reports/users'); }}" class="nav-link {{ request()->is('admin/reports/users') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.user_report')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('reports/borrowers') }}" class="nav-link {{ request()->is('admin/reports/borrowers') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.borrower_report')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{  admin_url('reports/categories') }}" class="nav-link {{ request()->is('admin/reports/categories') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.category_report')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ admin_url('reports/category_languages') }}" class="nav-link {{ request()->is('admin/reports/category_languages') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="truncated-text">{{__('admin.category_lang_report')}}</p>
                </a>
              </li>
            </ul>
          </li>
          
          <!-- front-end settings -->
          {{-- @if(settings()->setting_frontend) --}}
          <li class="nav-item {{ request()->is('admin/shop_settings*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/shop_settings') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                {{__('admin.front_end_settings')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ admin_url('shop_settings') }}" class="nav-link {{ request()->is('admin/shop_settings') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('admin.shop_settings')}}</p>
                </a>
              </li>
              @if(config('app.apikeys'))
              <li class="nav-item">
                <a href="{{admin_url('shop_settings/apikeys')}}" class="nav-link {{ request()->is('admin/shop_settings/apikeys') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('admin.apikeys')}}</p>
                </a>
              </li>
              @endif
              @if(config('app.sliders'))
              <li class="nav-item">
                <a href="{{admin_url('shop_settings/slider')}}" class="nav-link {{ request()->is('admin/shop_settings/slider') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('admin.sliders')}}</p>
                </a>
              </li>
              @endif
              @if(config('app.banners'))
              <li class="nav-item">
                <a href="{{admin_url('shop_settings/banners')}}" class="nav-link {{ request()->is('admin/shop_settings/banners') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('admin.banners')}}</p>
                </a>
              </li> 
              @endif
            </ul>
          </li>
           <!-- end front-end settings -->
          <!-- <li class="nav-header"></li> -->
          @if(config('app.logout_button'))
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="nav-link btn btn-danger text-white btn-sm">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </button>
            </form>
          </li>
          @endif
        </ul>
      </nav>
    </div>
  </aside>
