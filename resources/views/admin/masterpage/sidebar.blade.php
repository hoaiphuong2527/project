	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="{{ URL::asset('/home') }}">
				<span>BOOKS</span>
			</a>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<a href="{{ URL::asset('/home') }}" class="dropdown-toggle">
						<span class="fa fa-home"></span><span class="mtext">Home</span>
					</a>
					<a href="{{ URL::asset('/users') }}" class="dropdown-toggle">
						<span class="fa fa-user"></span><span class="mtext">User</span>
					</a>
					<a href="{{ URL::asset('/categories') }}" class="dropdown-toggle">
						<span class="fa fa-bars"></span><span class="mtext">Category</span>
					</a>
					<a href="{{ URL::asset('/books') }}" class="dropdown-toggle">
						<span class="fa fa-book"></span><span class="mtext">Book</span>
					</a>
					<a href="{{ URL::asset('/orders') }}" class="dropdown-toggle">
						<span class="fa fa-pencil"></span><span class="mtext">Order</span>
					</a>
					
				</ul>
			</div>
		</div>
	</div>