@extends('layouts.default')
@section('title',isset($position) ? 'Update Job Position' : 'Add Job Postion')
@section('content')
<div class="inner-section-wrapper grey-bg upload-block">
 <form class="form-data" action="{{ isset($position) ? route('admin.position.update', $position->id) : route('admin.position.store') }}" method="post">
  @csrf
  @if(isset($position))
  @method('PUT')
  @endif
  <div class="form-wrapper position-form">
    <div class="form-group group-row align-center">
      <label>Title</label>
      <input type="text" name="title" class="validation-control" data-validation="required" value="{{old('title',$position->title ?? '')}}">
      @error('title')
      <span class="validation-error">{{$message}}</span>
      @enderror
    </div>
    <div class="form-group group-row">
      <label>Description</label>
      <textarea name="description"></textarea>
    </div>
    <div class="form-group group-row">
      <label>Duties</label>
      <div class="form-group group-column" style="width:100%">
        <div class="grid-row template-repeat-3 col-gap-10 row-gap-10" id="duty-field-items">
          @if(isset($position) && !empty($position?->duties))
            @foreach($position?->duties as $key=>$duty)
            <div class="form-group group-row">
              <input type="text" name="duties[]" value="{{$duty}}">
              @if($key >0)
              <button type="button" class="remove-field-btn"><i class="fa fa-times"></i></button>

              @endif
            </div>
            @endforeach
           @endif
        </div>
        <div class="form-group">
          <button title="Add Duties" class="primary-btn add-duty-field" type="button" >Add Duty</button>
        </div>
      </div>
    </div>
    <div class="form-group group-row">
       <label>Job Questions</label>
       <div class="form-group group-column row-gap-10" style="width:100%">
          <div class="question-field-items">
            @if(isset($position) && !empty($position?->job_questions))
            @foreach($position?->job_questions as $key=>$question)
              <div class="form-group group-column" data-index="{{$key}}">
                  <div class="form-group group-row col-gap-10">
                      <input type="text" name="job_questions[$key][title]" value="{{$question['title']}}" class="validation-control" data-validation="required" placeholder="Question Category">
                      <button type="button" class="remove-question-field-btn">
                          <i class="fa fa-times"></i>
                      </button>
                  </div>
                  <div class="grid-row template-repeat-3 col-gap-10 row-gap-10 question-duty-items">
                      @foreach($question['items'] as $item)
                          <div class="form-group group-row col-gap-10">
                              <input type="text" name="job_questions[$key][items][]" placeholder="Title"  class="validation-control" data-validation="required" value="{{$item}}">
                              <button type="button" class="remove-question-item-field-btn">
                                  <i class="fa fa-times"></i>
                              </button>
                          </div>
                      @endforeach
                  </div>
                  <div class="form-group">
                      <button type="button" class="primary-btn question-duty-btn">Add Duty</button>
                  </div>
              </div>
            @endforeach
            @endif
          </div>
          <div class="form-group">
              <button title="Add Duties" class="primary-btn add-question-field" type="button" >Add Job Question</button>
          </div>
       </div>
    </div>
    <div class="form-group group-row  flex-end">
      <button class="primary-btn" type="submit" id="submit-button">{{isset($position) ? 'Update' : 'Add'}} Job Position</button>
    </div>
  </div>
</form>
</div>
@endsection

@push('js')
@include('scripts.validation')
<script type="text/javascript">
  (function(){
    function Initial(){
      let _this = this
      let counter = parseInt(`{{ isset($position) && !empty($position->job_questions) && count($position->job_questions) > 0 ? count($position->job_questions) : 0 }}`);
      this.dutiesFieldListener =function(){
        const btn = $('.add-duty-field')
        const target = $('#duty-field-items')
        btn.on('click',function(){
          const group = $('<div />',{
            class:'form-group group-row col-gap-10'
          })
          const input = $('<input />',{
            name:'duties[]',
            type:'text',
            placeholder:'Title',
            class:'validation-control',
            "data-validation" : 'required'
          })
          const removeBtn = $('<button />',{
            type:'button',
            class:"remove-field-btn"
          })
          const removeIcon = $('<i />',{
            class:'fa fa-times'
          })
          removeBtn.append(removeIcon)
          group.append(input)
          group.append(removeBtn)
          target.append(group)
        })

        $(document).on("click",'.remove-field-btn',function(){
          $(this).parent().remove()

        })
      }

      this.questionFieldListener = function(){
        const btn = $('.add-question-field')
        const target = $('.question-field-items')
        
        btn.on('click',function(){
          const group = $('<div />',{
            class:'form-group group-column',
            'data-index' : counter
          })
          const catGroup = $('<div/>',{
            class:'form-group group-row col-gap-10'
          })
          const catInput = $('<input />',{
            type:'text',
            placeholder:'Question Category',
            name:`job_questions[${counter}][title]`
          })
            const removeBtn = $('<button />',{
                type:'button',
                class:"remove-question-field-btn"
              })
              const removeIcon = $('<i />',{
                  class:'fa fa-times'
              })
              removeBtn.append(removeIcon)

          const grid = $('<div />',{
            class:'grid-row template-repeat-3 col-gap-10 row-gap-10 question-duty-items',

          })

          const addDutyFieldWrapper= $('<div />',{
            class:'form-group',

          })
          const addDutyBtn = $('<button />',{
            class:'primary-btn question-duty-btn',
            type:'button',
            text:'Add Duty'
          })
          addDutyFieldWrapper.append(addDutyBtn)
          catGroup.append(catInput)
          catGroup.append(removeBtn)
          group.append(catGroup)
          group.append(grid)
          group.append(addDutyFieldWrapper)
          target.append(group)
          counter = counter + 1
          

        })

        $(document).on('click','.question-duty-btn',function(){

             const index = $(this).parent().parent().data('index')
              const dutyItem = $('<div />',{
                class:"form-group group-row col-gap-10"
              })
             const input = $('<input />',{
                type:'text',
                placeholder:'Title',
                name:`job_questions[${parseInt(index)}][items][]`,
                class:'validation-control',
                "data-validation":'required'
             })
              const removeBtn = $('<button />',{
                type:'button',
                class:"remove-question-item-field-btn"
              })
              const removeIcon = $('<i />',{
                  class:'fa fa-times'
              })
              removeBtn.append(removeIcon)
             dutyItem.append(input)
             dutyItem.append(removeBtn)
             $(this).parent().prev().append(dutyItem)

          })
         $(document).on("click",'.remove-question-item-field-btn',function(){
            $(this).parent().remove()


        })
        $(document).on("click",'.remove-question-field-btn',function(){
            $(this).parent().parent().remove()
            counter = counter - 1

        })
      

      }

      this.init = function(){
        _this.dutiesFieldListener()
        _this.questionFieldListener()
      }
    }
    let initialObj = new Initial()
    initialObj.init()
  })()
</script>
@endpush