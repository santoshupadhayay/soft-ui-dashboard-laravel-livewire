<main class="main-content">
  <div class="container-fluid py-4">
      {{-- Tables --}}
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>
                Streams
                <a href="{{ route('addStream') }}"
                  class="btn btn-primary active mb-0 text-white" style="float: right" role="button" aria-pressed="true">
                  Add
                </a>
              </h6>
              
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stream</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Added At</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($streams && count($streams) != 0)
                      @foreach ($streams as $stream)
                        <tr>
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div>
                                <img src="{{ asset($stream->icon) }}" class="avatar avatar-sm me-3">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $stream->name }}</h6>
                              </div>
                            </div>
                          </td>
                          <td class="align-middle text-center text-sm">
                            @if($stream->status == true)
                              <span class="badge badge-sm bg-gradient-success">Active</span>
                            @else
                              <span class="badge badge-sm bg-gradient-secondary">Inactive</span>
                            @endif
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ date('d M Y H:i:s a', strtotime($stream->created_at)) }}</span>
                          </td>
                          <td class="align-middle">
                            <a href="{{ route('editStream',['id' => $stream->id]) }}" class="badge badge-sm bg-gradient-success" data-toggle="tooltip" data-original-title="Edit">
                              Edit
                            </a>
                            <a href="{{ route('deleteStream',['id' => $stream->id]) }}" class="badge badge-sm bg-gradient-secondary" data-toggle="tooltip" data-original-title="Delete">
                              Delete
                            </a>
                          </td>
                        </tr>  
                      @endforeach
                    @else
                      <tr>
                        <td colspan="4" class="text-center">
                          <span class="badge badge-sm bg-gradient-success">No Record To Display</span>
                        </td>
                      </tr>
                    @endif
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</main>
