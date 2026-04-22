<x-layout title="Edit Item">
    <section class="section">
      <div class="row">
        <div class="">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Item</h5>

              <!-- General Form Elements -->
              <form method="POST" action="{{ route('items.update', $item->id) }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="{{ $item->name }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" name="description">{{ $item->description }}</textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">SKU</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="sku" value="{{ $item->sku }}">
                    @error('sku')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Quantity</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="quantity" value="{{ $item->quantity }}">
                    @error('quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Minimum Stock Level</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="min_stock_level" value="{{ $item->min_stock_level }}">
                    @error('min_stock_level')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Category</label>
                  <div class="col-sm-10">
                    <select name="category_id" class="form-select" aria-label="Default select example">
                      <option selected>--Select Category--</option>
                      @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Location</label>
                  <div class="col-sm-10">
                    <select name="location_id" class="form-select" aria-label="Default select example">
                      <option selected>--Select Location--</option>
                      @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ $item->location_id == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                      @endforeach
                    </select>
                    @error('location_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
    </section>
</x-layout>