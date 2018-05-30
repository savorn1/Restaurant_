<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>

<li><a href="{{  backpack_url('language') }}"><i class="fa fa-flag-o"></i> <span>Languages</span></a></li>
<li><a href="{{ backpack_url( 'language/texts') }}"><i class="fa fa-language"></i> <span>Language Files</span></a></li>
<li><a href='{{ url(config('backpack.base.route_prefix', 'admin').'/backup') }}'><i class='fa fa-hdd-o'></i> <span>Backups</span></a></li>

<!-- <li><a href="{{ backpack_url('log') }}"><i class="fa fa-terminal"></i> <span>Logs</span></a></li>
<li><a href='{{ url(config('backpack.base.route_prefix', 'admin') . '/setting') }}'><i class='fa fa-cog'></i> <span>Settings</span></a></li>
<li><a href="{{backpack_url('page') }}"><i class="fa fa-file-o"></i> <span>Pages</span></a></li>

<li><a href="{{backpack_url('vehicle') }}"><i class="fa fa-file-o"></i> <span>Vehicle</span></a></li>
<li><a href="{{backpack_url('customer') }}"><i class="fa fa-file-o"></i> <span>Customer</span></a></li>

<li><a href="{{backpack_url('task-type') }}"><i class="fa fa-file-o"></i> <span>Task Type</span></a></li>
<li><a href="{{backpack_url('task-manager') }}"><i class="fa fa-file-o"></i> <span>Task Manager</span></a></li>
 -->
<li><a href='{{ url(config('backpack.base.route_prefix', 'admin').'/category') }}'><i class='fa fa-hdd-o'></i> <span>Category</span></a></li>
<li><a href='{{ url(config('backpack.base.route_prefix', 'admin').'/product') }}'><i class='fa fa-hdd-o'></i> <span>Product</spa></a></li>
<li><a href='{{ url(config('backpack.base.route_prefix', 'admin').'/table') }}'><i class='fa fa-hdd-o'></i> <span>Table</spa></a></li>
