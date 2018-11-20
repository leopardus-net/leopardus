<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @foreach( $leftSidebar as $sidebar )
                    
                    <li class="nav-small-cap" style="text-transform: uppercase;">
                        @lang("left-sidebar.$sidebar->slug.name")
                    </li>

                    @foreach( $sidebar->items as $item )
                        <li>
                            <a class="@if( $item->children->count() ) has-arrow @endif waves-effect waves-dark" 
                                href="{{ $item->route ? url( $item->route ) : '#' }}" aria-expanded="false">
                                <i class="{{ $item->icon }}"></i>
                                <span class="hide-menu">
                                    @lang("left-sidebar.$sidebar->slug.childrens.$item->slug.name")
                                </span>
                            </a>
                            @if( $item->children->count() )
                                <ul aria-expanded="false" class="collapse">
                                    @foreach( $item->children as $second )
                                        <li>
                                            <a href="{{ $second->route ? url( $second->route ) : '#' }}">
                                                @lang("left-sidebar.$sidebar->slug.childrens.$item->slug.childrens.$second->slug.name")
                                            </a>
                                            @if( $second->children->count() )
                                                <ul aria-expanded="false" class="collapse">
                                                    @foreach( $second->children as $three)
                                                        <li>
                                                            <a href="{{ url( $three->route ) }}">
                                                                @lang("left-sidebar.$sidebar->slug.childrens.$item->slug.childrens.$second->slug.childrens.$three->slug.name")
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                    
                    <li class="nav-devider"></li>
                @endforeach
                <br>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <!-- item-->
        <a href="{{ route('profile.settings') }}" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
  
        <!-- item-->
        <a href="{{ route('profile') }}" class="link" data-toggle="tooltip" title="Account"><i class="mdi mdi-account"></i></a>
        
        <!-- item-->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="link" data-toggle="tooltip" title="Logout">
            <i class="mdi mdi-power"></i></a> 
        </div>
    <!-- End Bottom points-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->