<x-layout title="Create Transaction">
    <section class="section">
      <div class="row">
        <div class="">
           @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Create Transaction</h5>

              <!-- General Form Elements -->
              <form method="POST" action="{{ route('transactions.store') }}">
                @csrf
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Item</label>
                  <div class="col-sm-10">
                    <select name="item_id" class="form-select" aria-label="Default select example">
                      <option selected>--Select Item--</option>
                      @foreach($items as $item)
                        <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                      @endforeach
                    </select>
                    @error('item_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Type</label>
                  <div class="col-sm-10">
                    <select name="type" class="form-select" aria-label="Default select example">
                      <option selected>--Select Type--</option>
                      <option value="IN" {{ old('type', $transaction->type ?? '') == 'IN' ? 'selected' : '' }}>IN</option>
                      <option value="OUT" {{ old('type', $transaction->type ?? '') == 'OUT' ? 'selected' : '' }}>OUT</option>
                      <option value="ADJUSTMENT" {{ old('type', $transaction->type ?? '') == 'ADJUSTMENT' ? 'selected' : '' }}>ADJUSTMENT</option>
                    </select>
                    @error('type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Quantity</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="quantity" value="{{ old('quantity') }}">
                    @error('quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Reason</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" name="reason">{{ old('reason') }}</textarea>
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