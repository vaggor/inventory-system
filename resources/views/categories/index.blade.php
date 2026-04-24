<x-layout title="Category List">
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
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
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
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                      <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>
                        <button type="button" 
                            class="btn btn-danger btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteCategoryModal{{ $category->id }}"
                            data-id="{{ $category->id }}"
                            data-name="{{ $category->name }}">
                            Delete
                        </button>
                    </td>
                  </tr>

                  <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteCategoryModal{{ $category->id }}" tabindex="-1">
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

                                    <form id="deleteForm" method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <script>
                        const deleteModal = document.getElementById('deleteCategoryModal{{ $category->id }}');
                        deleteModal.addEventListener('show.bs.modal', function (event) {
                            const button = event.relatedTarget;
                            const id = button.getAttribute('data-id');
                            const name = button.getAttribute('data-name');

                            document.getElementById('itemName').textContent = name;
                            document.getElementById('deleteForm').action = '/categories/' + id;
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