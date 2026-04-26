<ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('dashboard.index') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-box-seam"></i><span>Items</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('items.index') }}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
          <li>
            <a href="{{ route('items.create') }}">
              <i class="bi bi-circle"></i><span>New Item</span>
            </a>
          </li>
        </ul>
      </li><!-- End Item Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#transactions-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-box"></i><span>Transactions</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="transactions-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('transactions.index') }}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
          <li>
            <a href="{{ route('transactions.create') }}">
              <i class="bi bi-circle"></i><span>New Transaction</span>
            </a>
          </li>
        </ul>
      </li><!-- End Transaction Nav -->

      @if(auth()->user()->role === 'admin')
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#category-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-tags"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="category-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('categories.index') }}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
          <li>
            <a href="{{ route('categories.create') }}">
              <i class="bi bi-circle"></i><span>New Category</span>
            </a>
          </li>
        </ul>
      </li><!-- End Category Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#location-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-geo-alt"></i><span>Location</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="location-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('locations.index') }}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
          <li>
            <a href="{{ route('locations.create') }}">
              <i class="bi bi-circle"></i><span>New Location</span>
            </a>
          </li>
        </ul>
      </li><!-- End Location Nav -->

    </ul>
    @endif