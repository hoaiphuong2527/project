	<div class="pre-loader"></div>
	<div class="header clearfix">
		<div class="header-right">
			<div class="brand-logo">
				<a href="index.php">
					<img src="{{ URL::asset('admin/images/deskapp-color-logo.png') }}" alt="" class="mobile-logo">
				</a>
			</div>
			<div class="menu-icon">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
			
			<div class="user-info-dropdown">
				<div class="dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						{{ Auth::user()->username }} <span class="caret"></span>
						</a>

						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{ route('user.detail', ['id' => Auth::user()->id,
                                                                        '_token' => csrf_token()
                                                                    ]) }}">
								{{ __('Your infor') }}
							</a>
							<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>		
								
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
				</div>
			</div>
		</div>
	</div>