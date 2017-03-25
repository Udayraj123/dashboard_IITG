@extends('student_search.master')
@section('head')
<link href="{{ asset('DataTables-1.10.7/bootstrap/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('DataTables-1.10.7/extensions/TableTools/css/dataTables.tableTools.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    @-moz-document url-prefix() {
        fieldset {
            display: table-cell;
        }
    }
</style>
@endsection
@section('content')
<section class="content-header">
    <br>
    <br>
    <br>
    <div class="row" align="center">
        <div class="col-md-2"></div>
        <div class="col-md-2">
            <h1 class="form-inline">
              Search Students
          </h1>
      </div>
      <div class="col-md-2"></div>
  </div>
  <br>    
  @if($errors->has())
  <div class="alert alert-danger" role="alert" style="padding:4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row" align="center">

    <div class="col-md-2"></div>
    <div class="col-md-4">
     <div class="panel panel-primary">
         <div class="panel-heading">
             <h3 class="panel-title">Search By Name</h3>
         </div>
         <div class="panel-body">
             <form class="form-inline" method="post" action="{{ route('postSearchStud') }}">
                 <div class="form-group">
                     <label for="value" class="control-label">Name:</label>
                     <input type="text" class="form-control" name="value" required>
                 </div>
                 <button type="submit" class="btn btn-primary pull-right" value="Search"><span class="glyphicon glyphicon-search"></span></button>
             </form>
         </div>
     </div>
 </div>
 <div class="col-md-4">
     <div class="panel panel-primary">
         <div class="panel-heading">
             <h3 class="panel-title">Search By Any Column</h3>
         </div>
         <div class="panel-body">
             <form class="form-inline" method="post" action="{{ route('postSearchStud') }}">
                 <div class="form-group">
                     <label for="col" class="control-label">Column:</label>
                     <?php  $fresher_fields=C::get('stud.fresher_fields'); ?>
                     <select class="form-control"  name="col">
                         @foreach($fresher_fields as $f=>$c)
                         <option value="{{$c}}">{{$f}}</option>
                         @endforeach
                     </select>
                     &emsp;
                     <label for="value" class="control-label">Value:</label>
                     <input type="text" class="form-control" name="value" required>
                 </div>
                 <button type="submit" class="btn btn-primary pull-right" value="Search"><span class="glyphicon glyphicon-search"></span></button>
             </form>
         </div>
     </div>
 </div>
 {{--
 <div class="col-md-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Search By Semester</h3>
        </div>
        <div class="panel-body" id="searchBySem">
            Search Interface. 
        </div>
    </div>
</div>
<div>
    <div id="studsearchbysem"></div>
</div>
--}}

</div>

</section>
@if(isset($studs))
<section class="content">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-3">
            <h4>Number of Students: {{ count($studs) }}</h4>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header">
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table id="2" class="table table-bordered table-striped table-hover dataTable reps">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Time Table</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($studs as $stud)

                            <tr>
                                <td> 
                                    <?php $details = $stud->getDetails();?>
                                    <button class="btn btn-sm bg-info showMore" @foreach($details as $n=>$v) data-{{strtolower($n)}}="{{ $v }}"@endforeach > 
                                        {{ $stud->name }} 
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm bg-warning getTimeTableModal" data-id="{{ $stud->id }}"> Get Time Table </button>
                                </td>
                            </tr>
                            @endforeach
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Time Table</th>
                                </tr>
                            </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<div class="modal fade" id="getTimeTableModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Time Table
            </div>
            <div class="modal-body" style="width:60%" id ="getTimeTableModalContent"> 
                Time Table 
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="showMoreModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Details 
            </div>
            <?php $detailFields = C::get('stud.fresher_fields'); ?>
            <div class="modal-body"> 
                <table class="table" style="font-family: Ubuntu;font-size: 20px;"> 
                    @foreach($detailFields as $n=>$d)
                    <tr>
                        <td>{{$n}}</td>
                        <td id="details_{{strtolower($n)}}">{{$d}}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<!-- DATA TABES SCRIPT -->
<script src="{{ asset('DataTables-1.10.7/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('DataTables-1.10.7/bootstrap/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('DataTables-1.10.7/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
<script type="text/javascript">
    var tables = $('.dataTable').DataTable();
    $(window).resize( function () {
        tables.columns.adjust();
    } );
    $('.dataTable').on('click','.showMore',function(){        
        // Kim that you have
        @foreach($detailFields as $n=>$d)
        $('#details_{{strtolower($n)}}').html($(this).data('{{strtolower($n)}}'));
        @endforeach
        $('#showMoreModal').modal('show');
    });

    $('.getTimeTableModal').on('click', function(e) {
        id= $(this).data('id');
        $.ajax({
            url: '{{ route('getTimeTableModal') }}',
            method: 'post',
            data: {'id':id}
        })
        .success(function (result) {
            $('#getTimeTableModalContent').html(result);
            $('#getTimeTableModal').modal('show');
        });
    });

    $(window).on('load', function(){
        mode='student_search';
        divID = '#searchBySem';
        selector='#studsearchbysem';
        //change above two only
        {{-- $.ajax({url: "{{route('searchbycity')}}", method: 'post', data: {'mode':mode,'selector':selector}, success: function(result) {$(divID).html(result); } }); --}}
    });

        $(document).ready(function() {
            $("#student_search").addClass("active");
        });
    </script>

    @endsection