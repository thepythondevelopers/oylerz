@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Coupons</h3>
                <div class="btn-grp">
                <a href="{{route('admin.coupon.add')}}"  class="main-btn primary-btn mr-3"> New Coupon </a>
                 <a class="main-btn btn-danger" id="bulk_delete_btn"><i class="voyager-trash"></i> <span>Bulk Delete</span></a>
                 </div>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Coupons</h3>
                        </div>
                    <div class="csm-body">  
                        <div class="table-responsive">
                            <table class="table dash-table" id="dataTable">
                              <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="custom-control custom-checkbox without-label">
                                         <input type="checkbox" class="custom-control-input select_all" id="customCheck1" >
                                         <label class="custom-control-label" for="customCheck1"></label>
                                        </div>
                                    </th>  
                                  <th>Title</th>
                                  <th>Discount</th>
                                  <th>Type</th>
                                  <th>Description</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($coupon as $key=>$b)
                                <tr>
                                  <td class="checkbox_in">
                                    <div class="custom-control custom-checkbox without-label">
                                        <input type="checkbox" class="custom-control-input " name="row_id" id="checkbox_{{$b->id}}" value="{{$b->id}}">
                                        <label class="custom-control-label" for="checkbox_{{$b->id}}"></label>
                                    </div>
                                    </td>
                                  <td>{{$b->title}}</td>
                                  <td>{{$b->discount}}</td>
                                  <td>{{ $b->type==0 ? 'Fixed' : 'Percentage' }}</td>
                                  <td>{!! substr($b->description,0,50) !!}</td>

                                  
                                  <td class="no-sort no-click" id="bread-actions">
                                        <div class="action-btns">
                                        <a href="javascript:void(0)" title="Delete" class="icon-btn btn-danger delete" data-id="{{$b->id}}" id="delete-{{$b->id}}"><i class="voyager-trash"></i> <span class="hidden-xs hidden-sm"><i class='bx bxs-trash' ></i></span></a>
                                         
                                        <a href="{{route('admin.coupon.view',$b->id)}}" title="View" class="icon-btn view btn-primary"><i class='bx bxs-show' ></i></a>
                                        </div>
                                    </td> 
                                  
                                </tr>                  
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                  </div>  
            </div>
        </div>
@stop        

@section('modal')


        {{-- Single delete modal --}}


  <div id="delete_modal" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header flex-column">
        <div class="icon-box">
          <i class="material-icons">&#xE5CD;</i>
        </div>            
        <h4 class="modal-title w-100">Are you sure?</h4>  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>Do you really want to delete this coupon?</p>
      </div>
      <div class="modal-footer justify-content-center">
        <form action="{{route('admin.coupon.delete','id')}}" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger delete-confirm" value="Confirm">
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

  {{-- Multiple delete modal --}}
  <div id="bulk_delete_modal" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header flex-column">
        <div class="icon-box">
          <i class="material-icons">&#xE5CD;</i>
        </div>            
        <h4 class="modal-title w-100">Are you sure?</h4>  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete  <span id="bulk_delete_count"></span> <span id="bulk_delete_display_name"></span>?</p>
      </div>
      <div class="modal-footer justify-content-center">
        <form action="{{route('admin.coupon.delete.all')}}" id="bulk_delete_form" method="POST">
                    
                    {{ csrf_field() }}
                    <input type="hidden" name="ids" id="bulk_delete_input" value="">
                    <input type="submit" class="btn btn-danger delete-confirm"
                             value="Yes, Delete These">
                </form>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">

                    Cancel

                </button>
      </div>
    </div>
  </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
               
                var table = $('#dataTable').DataTable({!! json_encode(
                    array_merge([
                        "order" => [],
                      
                        "columnDefs" => [['targets' => -1, 'searchable' =>  false, 'orderable' => false]],
                    ])
                , true) !!});
       });


    $('.select_all').on('click', function(e) {
                $('input[name="row_id"]').prop('checked', $(this).prop('checked'));
            });




 var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            const textToReplace = $('#delete_form').attr('action');
            const newText = textToReplace.replace("id", $(this).data('id'));
            $('#delete_form').attr('action',newText);            
            $('#delete_modal').modal('show');
        });

        window.onload = function () {
    // Bulk delete selectors
    var $bulkDeleteBtn = $('#bulk_delete_btn');
    var $bulkDeleteModal = $('#bulk_delete_modal');
    var $bulkDeleteCount = $('#bulk_delete_count');
    var $bulkDeleteDisplayName = $('#bulk_delete_display_name');
    var $bulkDeleteInput = $('#bulk_delete_input');
    // Reposition modal to prevent z-index issues
    $bulkDeleteModal.appendTo('body');
    // Bulk delete listener
    $bulkDeleteBtn.click(function () {
        var ids = [];
        var $checkedBoxes = $('#dataTable input[type=checkbox]:checked').not('.select_all');
        var count = $checkedBoxes.length;
        if (count) {
            // Reset input value
            $bulkDeleteInput.val('');
            // Deletion info
            var displayName = count > 1 ? 'Coupons' : 'Coupon';
            displayName = displayName.toLowerCase();
            $bulkDeleteCount.html(count);
            $bulkDeleteDisplayName.html(displayName);
            // Gather IDs
            $.each($checkedBoxes, function () {
                var value = $(this).val();
                ids.push(value);
            })
            // Set input value
            $bulkDeleteInput.val(ids);
            // Show modal
            $bulkDeleteModal.modal('show');
        } else {
            // No row selected
            toastr.warning('You haven&#039;t selected anything to delete');
        }
    });
}
</script>
@stop