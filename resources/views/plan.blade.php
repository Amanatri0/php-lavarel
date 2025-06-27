@extends('layouts.main')

@section('title')
    {{ __('plan') }}
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('create_and_manage') . ' ' . __('plan') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-dark">
                            <a href="{{ route('home') }}" class="text-dark">
                                <i class="fas fa-home mr-1"></i>{{ __('dashboard') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <i class="nav-icon fas fa-cube mr-1"></i>{{ __('plan') }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button id="toggleButton" class="btn btn-primary mb-3 ml-1">
                        <i class="fas fa-plus-circle mr-2"></i>{{ __('create') . ' ' . __('plan') }}
                    </button>
                </div>

                <div class="col-md-12" id="add_card">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('create') . ' ' . __('plan') }}</h3>
                        </div>
                        <form action="{{ url('plan') }}" method="POST" onsubmit="return saveOrder()">
                            @csrf
                            <div class="form-group">
                                <label for="name">Plan Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" step="0.01" class="form-control" name="price" id="price"
                                    required>
                            </div>

                            <button type="submit" class="btn btn-primary">Save Plan</button>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Plan List Table -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('plan') . ' ' . __('list') }}</h3>
                        </div>
                        <div class="card-body">
                            <table id="table" data-toggle="table" data-url="{{ route('planList') }}"
                                data-side-pagination="server" data-pagination="true" data-search="true"
                                data-show-columns="true" data-show-refresh="true" data-mobile-responsive="true"
                                data-buttons-class="primary" data-sort-name="id" data-sort-order="asc">
                                <thead>
                                    <tr>
                                        <th data-field="id" data-sortable="true">{{ __('id') }}</th>
                                        <th data-field="name">{{ __('name') }}</th>
                                        <th data-field="description">{{ __('description') }}</th>
                                        <th data-field="price">{{ __('price') }}</th>
                                        <th data-field="created_at" data-sortable="true">{{ __('created_at') }}</th>
                                        <th data-field="updated_at" data-sortable="true">{{ __('updated_at') }}</th>
                                        <th data-field="operate" data-events="actionEvents">{{ __('operate') }}</th>
                                    </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editDataModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ __('edit') . ' ' . __('plan') }}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form id="update_form" action="{{ url('plan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="edit_id" id="edit_id">
                            <input type="hidden" name="image_url" id="image_url">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="required">{{ __('name') }}</label>
                                        <input type="text" name="name" id="edit_name" class="form-control"
                                            required>
                                    </div>
                                    <!-- Add more fields as needed -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">{{ __('update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@section('script')

<script type="text/javascript">
        $(function() {
            $("#sortable-row").sortable();
        });

        function saveOrder() {
            var selectedLanguage = new Array();
            $('ol#sortable-row li').each(function() {
                selectedLanguage.push($(this).attr("id"));
            });
            document.getElementById("row_order").value = selectedLanguage;
        }
window.actionEvents = {
        'click .edit-data': function(e, value, row, index) {
            $('#edit_id').val(row.id);
            $('#edit_name').val(row.category_name);
        }
    }
</script>
    <script>
        $('#table').bootstrapTable({
            // Other bootstrap-table configurations
            onPostBody: function() {
                // Event listeners for edit and delete buttons
                $('.edit-data').on('click', function() {
                    var id = $(this).data('id');
                    var name = $(this).data('name');
                    // Populate modal fields and show modal
                    $('#edit_id').val(id);
                    $('#edit_name').val(name);
                    $('#editDataModal').modal('show');
                });

                $('.delete-form').on('click', function() {
                    var id = $(this).data('id');
                    var url = $(this).data('url');
                    // Handle delete logic
                    if (confirm('Are you sure you want to delete this plan?')) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                alert('Deleted successfully');
                                location.reload();
                            },
                            error: function(error) {
                                alert('An error occurred');
                            }
                        });
                    }
                });
            }
        });
    </script>

    <script type="text/javascript">
        function queryParams(p) {
            return {
                sort: p.sort,
                order: p.order,
                limit: p.limit,
                offset: p.offset,
                search: p.search,
                language_id: $('#filter_language_id').val(),
            };
        }
    </script>
@endsection
