<x-layout title="Item Details">
    <section class="section profile">
      <div class="row">
        
        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
             
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Description</h5>
                  <p class="small fst-italic">{{ $item->description }}</p>

                  <h5 class="card-title">Item Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Name</div>
                    <div class="col-lg-9 col-md-8">{{ $item->name }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Category</div>
                    <div class="col-lg-9 col-md-8">{{ $item->category->name }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Location</div>
                    <div class="col-lg-9 col-md-8">{{ $item->location->name }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Quantity</div>
                    <div class="col-lg-9 col-md-8">{{ $item->quantity }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Minimum Stock Level</div>
                    <div class="col-lg-9 col-md-8">{{ $item->min_stock_level }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">SKU</div>
                    <div class="col-lg-9 col-md-8">{{ $item->sku }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Updated At</div>
                    <div class="col-lg-9 col-md-8">{{ $item->updated_at }}</div>
                  </div>

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
</x-layout>