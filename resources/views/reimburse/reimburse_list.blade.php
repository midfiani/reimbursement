@extends('adminlte::page')

@section('title','Reimburse List')
@section('content_header')
    <h1>Pengajuan Reimbursement List</h1>
@stop

@section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                               <strong>{{  session('success') }}</strong>
                                
                              </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{  session('error')}} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                            @endif

                            <div class="float-right">
                                <a href="{{ route('REIMBURSE.create')}}" class="btn btn-success">
                                    <i class="fas fa-plus"></i>
                                    Creates</a>

                            </div>
                            <table class="table table-strip">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nama Reimbursement</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Status</th>
                                    @if ($user->level != "STAFF")
                                        <th scope="col" width="350px">Action</th>
                                    @endif
                                  </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data_reimburse as $c)
                                    <tr>
                                        <th scope="row">{{ ++$i }}</th>
                                        <td>{{ date('d F Y', strtotime($c->created_at)); }}</td>
                                        <td>{{ $c->reimburse_name }}</td>
                                        <td>{{ $c->description }}</td>
                                        <td>
                                            <a href="{{URL::to('/').asset('images/'.$c->file_name )}}" target="_blank">{{$c->file_name}}</a></td>
                                        <td>
                                            @if($c->status == 5)
                                                <span class="badge bg-danger">REJECTED (By  Finance)</span>
                                            @elseif($c->status == 4)
                                                <span class="badge bg-success">PAID</span>
                                            @elseif($c->status == 3)
                                                <span class="badge bg-danger">REJECTED (By  Direktur)</span>
                                            @elseif($c->status == 2)
                                                <span class="badge bg-info">APPROVED</span>
                                            @else
                                                <span class="badge bg-secondary">PENDING</span>
                                            @endif
                                        </td>
                                        @if ($user->level == "DIREKTUR")
                                            @if ( $c->status == 1 )
                                            <td>
                                                <form action="{{ route('DIREKTUR.update',$c->id)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    @method('PUT')
                                                    <div class="input-group mb-3">
                                                        <select class="form-select" aria-label="Status" name="status">
                                                            <option value="1" {{$c->status == 1 ? 'selected':''}}>PENDING </option>
                                                            <option value="2" {{$c->status == 2 ? 'selected':''}}>APPROVED </option>
                                                            <option value="3" {{$c->status == 3 ? 'selected':''}}>REJECTED </option>
                                                        </select>
                                                        <button type="submit"  class="btn btn-outline-success">Update</button>
                                                    </div>
                                                </form>
                                            </td>
                                            @else
                                            <td>
                                                <small>No Access</small>
                                            </td>
                                            @endif
                                        @elseif($user->level == "FINANCE")
                                            @if ( $c->status == 2 )
                                            <td>
                                                <form action="{{ route('FINANCE.update',$c->id)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    @method('PUT')
                                                    <div class="input-group mb-3">
                                                        <select class="form-select" aria-label="Status" name="status">
                                                            <option value="2" {{$c->status == 2 ? 'selected':''}}>APPROVED </option>
                                                            <option value="4" {{$c->status == 4 ? 'selected':''}}>PAID </option>
                                                            <option value="5" {{$c->status == 5 ? 'selected':''}}>REJECTED </option>
                                                        </select>
                                                        <button type="submit"  class="btn btn-outline-success">Update</button>
                                                    </div>
                                                </form>
                                            </td>
                                            @else
                                            <td>
                                                <small>No Access</small>
                                            </td>
                                            @endif
                                        @endif
                                      </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No Data Available</td>
                                        </tr>
                                    @endforelse
                               
                                 
                                </tbody>
                              </table>
                              <div class="pagination-wrapper">
                                {{ $data_reimburse->links() }}
                              </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop

@section('js')
   <script>
       //fungsi dibawah untuk menghilangkan alert dengan efek fadeout   
        $("#success-alert").fadeTo(2000, 500).fadeOut(500, function(){
        $("#success-alert").fadeOut(500);
        });
   </script>
@stop