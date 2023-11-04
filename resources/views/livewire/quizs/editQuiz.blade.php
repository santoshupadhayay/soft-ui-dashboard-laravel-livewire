<main class="main-content">
  <div class="container-fluid py-4">
      {{-- Tables --}}
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
             
            </div>
            <div class="card-body pt-0 pb-2">
              <form method="post" action="{{ route('updateQuiz') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="quizName">Name</label>
                  <input name="id" type="hidden" value="{{ $quiz->id }}" />
                  <input type="text" name="name" class="form-control" id="quizName" aria-describedby="Name" placeholder="Name" value="{{ $quiz->name }}" required>
                </div>
                <div class="form-check">
                  <input {{ $quiz->status == true ? 'checked' : '' }}  name="status" type="checkbox" class="form-check-input" id="quizStatus">
                  <label class="form-check-label" for="quizStatus">Enabled</label>
                </div>
                <div class="form-group">
                  <label for="quizChapter">Chapter</label>
                  <select name="chapter_id" id="quizChapter" class="form-control" required>
                    @foreach ($chapters as $chapter)
                      <option {{ $quiz->chapter_id == $chapter->id ? 'selected' : '' }} value="{{ $chapter->id }}">{{ $chapter->name }}</option>
                    @endforeach
                  </select>
                </div>  
                <div class="form-group">
                  <label for="quizDescription">Description</label>
                  <textarea  name="description" class="form-control quizDescription" id="quizDescription" placeholder="Description" required>{{ $quiz->description }}</textarea>
                </div>

                <div class="form-group">
                  <a class="pull-right" data-toggle="modal" data-target="#addQuestionModal" style="float: right; curson:pointer"><span class="fa fa-plus"></span></a>
                  <h6 for="quizDescription">Questions</h6>
                </div>
                
                @php
                  $index = 0;
                @endphp 
                @foreach ($quiz->questions as $q)
                  <div class="form-group questionLists" >
                    <div id="accordion">
                      <div class="card">
                        <div class="card-header" style="padding: 5px" id="heading{{$index}}">
                          <h5 class="mb-0" data-toggle="collapse" data-target="#collapse{{$index}}" aria-expanded="true" aria-controls="collapseOne">
                            {{ $q->quesion }}
                          </h5>
                        </div>                  
                        <div id="collapse{{$index}}" class="collapse" aria-labelledby="heading{{ $index }}" data-parent="#accordion">
                          <div class="card-body">
                            <div class="table-responsive p-0">
                              <table class="table align-items-center mb-0">
                                <thead>
                                  <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Option</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Is Correct Answer</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($q->questionOptions as $option)
                                      <tr>
                                        <td>
                                            {{ $option->option }}
                                        </td>
                                        <td>
                                          @if($option->is_correct == 1)
                                            <span class="badge badge-sm bg-gradient-success">Correct Answer</span>
                                          @endif
                                        </td>
                                      </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>

                            <div class="row">
                              <div class="col-md-12">
                                <a href="{{ route('removeQuestion',['id'=>$q->id]) }}">
                                  <span class="badge badge-sm bg-gradient-secondary">Remove</span>
                                </a>
                              </div> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @php
                    $index++;
                  @endphp 
                @endforeach
                
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      @php
        
      @endphp
      <div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form method="post" action="{{ route('addQuestion') }}" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="questionName">Question</label>
                    <input name="id" type="hidden" value="{{ $quiz->id }}" />
                    <input type="text" name="name" class="form-control" id="questionName" aria-describedby="Name" placeholder="Name" required>
                  </div>
                  <div class="form-check">
                    <input name="status" type="checkbox" class="form-check-input" id="questionStatus">
                    <label class="form-check-label" for="questionStatus">Enabled</label>
                  </div>
                  <div class="form-group">
                    <label for="questionDescription">Description</label>
                    <textarea  name="description" class="form-control questionDescription" id="questionDescription" placeholder="Description" required></textarea>
                  </div>

                  <div class="form-group">
                    <a class="pull-right addOptions"><span class="fa fa-plus"></span></a>
                    <h6 for="quizDescription">Options</h6>
                  </div>

                  <div class="form-group optionLists" >
                    <div class="table-responsive p-0">
                      <table class="table align-items-center mb-0">
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Option</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Is Correct Answer</th>
                            <th class="text-secondary opacity-7"></th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                    <input type="hidden" name="optionsCorrect" class="optionsCorrect" value="">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>

  
  <style>
    .qstnBlock{
      border: 1px solid lightgray;
      border-radius: 6px;
    }
    .addOptions{
      float: right;
    }
  </style>
  <script>
    $(document).ready(function(){
      // tinymce.init({
      //   selector: '#chapterDescription',
      // });
      $('#quizChapter').select2({width:'100%'});
      
      function addOptions(){
        var html = '<tr>';
        html += '<td>';
        html += '<div class="form-group">';
        html += '<input type="text" name="optionsText[]" class="form-control optionName" id="" aria-describedby="Name" placeholder="Name" required>';
        html += '</div>';
        html += '</td>';
        html += '<td>';
        html += '<div class="form-check">';
        html += '<input name="optionsCorrect[]" type="checkbox" value="1" class="form-check-input correctOption">';
        html += '</div>';
        html += '</td>';
        html += '<td>';
        html += '<div class="form-check">';
        html += '<button type="button" class="btn btn-secondary removeOption">Remove</button>';
        html += '</div>';
        html += '</td>';
        html += '</tr>';
        $(".optionLists").find('tbody').append(html);
        $(".removeOption").click(removeOption);
        $(".correctOption").click(updateCorrectOption);
      }
      function updateCorrectOption(){
        var option = $(this).parent().parent().parent().find('.optionName').val();
        $("#addQuestionModal").find('.optionsCorrect').val(option);
      }

      function removeOption(){
        $(this).parent().parent().parent().remove();
      }
      $(".addOptions").click(addOptions);
    })
  </script>
</main>
