@extends('layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý điểm danh</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Attendance</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if(isset($view))
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Chọn lớp cần điểm danh</h3>
                </div>
                <!-- /.card-header -->
                <form method="post" action="/attendance/create">
                  @csrf
                <div class="card-body">
                  <div class="row margin">
                    <div class="col-sm-12">
                      <h3>Tên lớp + môn học:</h3>
                      <select name="idAssign" id="idAssign" class="form-control">
                          @foreach ($view as $view)
                              <option value="{{ $view->idAssign}}"> {{ $view->nameClass}}{{ $view->nameFaculty}} + {{ $view->nameSubject}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Điểm danh</button>
                </div>
                </form>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
        @endif
        <!-- /.row -->
        @if(isset($student))
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Điểm danh</h3>
              </div>
                <div class="card-body">

                  <div class="row">
                    <div class="col-sm-4">
                      <!-- radio -->
                      <div class="form-group">
                          Họ tên sinh viên (ngày nghỉ/tổng số ngày ) 
                      </div>
                    </div>
                    <div class="col-sm-8">
                      <!-- radio -->
                      <div class="form-group"> 
                          Tình trạng điểm danh
                      </div>
                    </div>
                  </div>

                    @foreach( $student as $student)
                    <div class="row">
                      <div class="col-sm-4">
                        <!-- radio -->
                        <div class="form-group">
                          {{ $index++}})  {{ $student->idStudent}} - {{ $student->lastName}} {{ $student->middleName}} {{ $student->firstName}}
                          
                        </div>
                      </div>
                      <div class="col-sm-8">
                        <!-- radio -->
                        <div class="form-group">
                          <div>
                            <b><input type="radio" id="status" name="{{ $student->idStudent}}" value="0" checked>Đi học</b> &nbsp;
                            <b><input type="radio" id="status" name="{{ $student->idStudent}}" value="1">Nghỉ học</b> &nbsp;
                            <b><input type="radio" id="status" name="{{ $student->idStudent}}" value="2">Muộn</b> &nbsp;
                            <b><input type="radio" id="status" name="{{ $student->idStudent}}" value="3">Có phép</b> &nbsp;
                            <b><input type="radio" id="status" name="{{ $student->idStudent}}" value="4">Không phép</b> &nbsp;
                          </div>                       
                        </div>
                      </div>
                    </div>
                    @endforeach
                    <div class="row">
                      <div class="col-sm-12">
                        <h4>
                          Tên lớp - môn học:
                        </h4>
                        <input type="text" readonly name="idAssign" id="idAssign" value="{{ $assign->idAssign}}" hidden>
                        <select name="idAssign" id="idAssign" class="form-control">
                          <option value="{{ $assign->idAssign}}">{{ $assign->nameClass}}{{ $assign->nameFaculty}} + {{ $assign->nameSubject}}</option>
                        </select>
                        <br>
                        Thời gian bắt đầu:
                        <select name="start" id="start" class="form-control">
                          <option value="08:00:00">8:00</option>
                          <option value="10:00:00">10:00</option>
                          <option value="13:30:00">13:30</option>
                          <option value="15:30:00">15:30</option>
                        </select>
                        <br>
                        Thời gian kết thúc:
                        <select name="end" id="end" class="form-control">
                          <option value="10:00:00">10:00</option>
                          <option value="12:00:00">12:00</option>
                          <option value="15:30:00">15:30</option>
                          <option value="17:30:00">17:30</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-5">
                      </div>
                      <div class="col-sm-7"> 
                        <br>
                        <button type="submit" class="btn btn-success" onclick="submitData()"> Cập nhật </button>
                      </div>
                    </div>

                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        @endif
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 @endsection
<script type="text/javascript">
    function submitData(){

        statusList = jQuery('input[type=radio]:checked')
        data = []
        for(i=0; i<statusList.length; i++){
          std = {
            'idStudent' : jQuery(statusList[i]).attr('name'),
            'status' : jQuery(statusList[i]).val()
          }
          data.push(std)
        }

        idAssign = jQuery('input[type=text]:hidden')
        id = []
          idA = {
            'idAssign' : jQuery(idAssign).attr('name'),
            'value' : jQuery(idAssign).val()
          }
          id.push(idA)


        var start = []
        var startTime = document.getElementsByName("start")[0]
        for (i = 0; i < startTime.options.length; ++i) {
          if (startTime.options[i].selected ) {
            sta = { start: startTime.id, value: startTime.options[i].value };
            start.push(sta)
            break;
          }
          
        }

        var end = []
        var endTime = document.getElementsByName("end")[0]
        for (i = 0; i < endTime.options.length; ++i) {
          if (endTime.options[i].selected ) {
            en = { end: endTime.id, value: endTime.options[i].value };
            end.push(en)
            break;
          }
          
        }

        $.post('{{ route('attendance_post')}}',{
          '_token': "{{ csrf_token() }}",
          'idAssign' : JSON.stringify(id),
          'start' : JSON.stringify(start),
          'end' : JSON.stringify(end),
          'data' : JSON.stringify(data)
        }, function(dt){
          location.reload()
        })
    }
</script>
