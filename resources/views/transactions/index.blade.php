<x-layout title="Transactions List">
    <section class="section">
       @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">Add New Transaction</a>
        </div>

      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item</th>
                    <th scope="col">User</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Type</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Reference Code</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $transaction->item->name }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->type }}</td>
                    <td>{{ $transaction->reason }}</td>
                    <td>{{ $transaction->reference_code }}</td>
                    <td>{{ $transaction->updated_at }}</td>
                    <td>
                      <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info btn-sm">View</a>
                      <!--<form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                      </form>-->
                        <button type="button" 
                            class="btn btn-danger btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteTransactionModal{{ $transaction->id }}"
                            data-id="{{ $transaction->id }}"
                            data-name="{{ $transaction->item->name }}">
                            Delete
                        </button>
                    </td>
                  </tr>

                  <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteTransactionModal{{ $transaction->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">⚠️ Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <p>Are you sure you want to delete <strong id="itemName"></strong>?</p>
                                    <p class="text-danger">This action cannot be undone.</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                    <form id="deleteForm" method="POST" action="{{ route('transactions.destroy', $transaction->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <script>
                        const deleteModal = document.getElementById('deleteTransactionModal{{ $transaction->id }}');
                        deleteModal.addEventListener('show.bs.modal', function (event) {
                            const button = event.relatedTarget;
                            const id = button.getAttribute('data-id');
                            const name = button.getAttribute('data-name');

                            document.getElementById('itemName').textContent = name;
                            document.getElementById('deleteForm').action = '/transactions/' + id;
                        });
                    </script>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
</x-layout>