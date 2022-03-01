@extends('layouts.app')
@section('content')
    <div>
        <div class="container">
            <div class="set-center">
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example" id="role" name="role">
                            <option value="null" selected disabled>Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role['id'] }}">{{ $role['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button id="btn-save" class="btn btn-success">Save</button>
                    </div>
                </div>
                <br>
                <div class="accordion" id="accordionExample">
                    @foreach ($dummy['actions'] as $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{ $item['label'] }}
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @foreach ($dummy['permissions'][$item['name']] as $permission)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" data-id=""
                                                data-permision="{{ $item['name'] }}"
                                                data-title="{{ $permission['name'] }}" type="checkbox" id="edit_post"
                                                value="{{ $permission['permission_id'] }}">
                                            <label class="form-check-label"
                                                for="inlineCheckbox1">{{ $permission['label'] }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <script type="text/javascript">
            let permissions = {
                ['post_permissions']: [],
                ['other_permissions']: []
            };
            let role = $('#role').find(":selected");

            $('#role').change(function() {
                role = $(this).find(":selected");
            });

            $("input[type='checkbox']").click(function() {
                let val = $(this).val();
                let data_attr = $(this).attr("data-permision");
                let data_attr_title = $(this).attr("data-title");

                if ($(this).is(':checked')) {
                    let obj = permissions[data_attr].findIndex(o => o.permission_id === val);
                    if (obj >= 0)
                        permissions[data_attr][obj] = {
                            permission_id: val,
                            name: data_attr_title,
                            status: 1
                        }
                    else
                        permissions[data_attr].push({
                            permission_id: val,
                            name: data_attr_title,
                            status: 1
                        });
                } else {
                    let obj = permissions[data_attr].findIndex(o => o.permission_id === val);
                    permissions[data_attr][obj] = {
                        permission_id: val,
                        name: data_attr_title,
                        status: 0
                    }
                }
            });

            $('#btn-save').click(function() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('permission.assign') }}",
                    type: 'POST',
                    dataType: 'json',
                    accept: 'application/json',
                    data: {
                        "role": role.val(),
                        "permissions": permissions
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
        </script>
    </div>
@endsection
<style>
    .set-center {
        margin: 50px 300px 0px 300px
    }

    .set-border {
        border: solid black;
        border-radius: 5px
    }

</style>
