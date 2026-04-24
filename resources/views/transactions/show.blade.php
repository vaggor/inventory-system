<x-layout title="Transaction Details">
    <section class="section profile">
      <div class="row">
        
        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
             
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Reason</h5>
                  <p class="small fst-italic">{{ $transaction->reason }}</p>

                  <h5 class="card-title">Transaction Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Item</div>
                    <div class="col-lg-9 col-md-8">{{ $transaction->item->name }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Quantity</div>
                    <div class="col-lg-9 col-md-8">{{ $transaction->quantity }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Type</div>
                    <div class="col-lg-9 col-md-8">{{ $transaction->type }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Reference Code</div>
                    <div class="col-lg-9 col-md-8">{{ $transaction->reference_code }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Performed by</div>
                    <div class="col-lg-9 col-md-8">{{ $transaction->user->name }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Updated At</div>
                    <div class="col-lg-9 col-md-8">{{ $transaction->updated_at }}</div>
                  </div>

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
</x-layout>