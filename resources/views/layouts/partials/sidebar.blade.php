<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('img/default.png  ')}}" widh="15px" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        {{--
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        --}}
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li class="header navy-hover"><a class="navy-hover" href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li class="white-hover"><a class="white-hover" href="{{ route('machine.view') }}"><i class='fa fa-link'></i> <span>Maquina</span></a></li>        
            	
            	<li class="orange-hover"><a class="orange-hover" href="{{ route('configuration.view') }}"><i class='fa fa-link'></i> <span>Configuraciones</span></a></li>            
            	<li class="purple-hover"><a class="purple-hover" href="{{ route('product.view') }}"><i class='fa fa-link'></i> <span>Productos</span></a></li>
	    
            <li class="treeview ">
                <a href="#" class="red-hover"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.register') }}s</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('sale.view')}}">Ventas</a></li>
                    <li><a href="{{route('stat.view')}}">Cronica de eventos</a></li>
                    <li><a href="{{route('stat.report.view')}}">Reportes</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a class="green-hover"  href="#"><i class='fa fa-link'></i> <span>Publicidad</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('company.view')}}">Compañias</a></li>
                    <li><a href="{{route('publicity.view')}}">Publicidades</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>