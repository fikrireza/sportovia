@extends('backend.layouts.app')

@section('title')
<title>Sportopia | Schedule</title>
@endsection


@section('breadcrumb')
<div id="content-header">
  <div id="breadcrumb">
    <a href="{{ route('dashboard') }}" title="Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
    <a href="" class="current">Add Schedule</a>
  </div>
  <h1>Add Schedule</h1>
</div>
@endsection

@section('content')

  @if (Session::has('gagal'))
    <script type="text/javascript">
      window.setTimeout(function() {
        $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
      }, 9000);
    </script>

    <div class="alert alert-danger alert-block" style="margin-bottom:0px;">
      <a class="close" data-dismiss="alert" href="#">×</a>
      <h4 class="alert-heading">Oops, Something Wrong!</h4>
      <hr style="margin:5px 0px 10px 0px; border-top-color:#dc9f9f;">
      {{ Session::get('gagal') }}
    </div>
  @endif


<div class="widget-box">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
      <h5>Add Schedule</h5>
      <a href="{{ route('jadwal.index') }}" class="btn btn-inverse pull-right"> Back</a>
    </div>
  <div class="widget-content nopadding">
    <form class="form-horizontal" method="post" action="{{ route('jadwal.classMemberStore') }}" name="basic_validate" id="basic_validate" novalidate="novalidate">
      {{ csrf_field() }}
      <div class="control-group {{ $errors->has('id_member') ? 'error' : ''}}">
        <label class="control-label">Student *</label>
        <div class="controls">
          <select class="span6" name="id_member" id="id_member">
            <option value="">--Choose--</option>
            @foreach ($getMember as $key)
            <option value="{{ $key->id }}" {{ old('id_member') == $key->id ? 'selected=""' : '' }}>{{ $key->kode_member}} | {{ $key->nama_member }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="control-group {{ $errors->has('id_kelas') ? 'error' : ''}}">
        <label class="control-label">Class Course *</label>
        <div class="controls">
          {{-- <select class="span6" name="id_kelas">
            <option value="">--Choose--</option>
            @foreach ($getKelas as $key)
            <option value="{{ $key->id }}" {{ old('id_kelas') == $key->id ? 'selected=""' : '' }}>{{ $key->kelasProgram->program_kelas}} | {{ $key->nama_kelas }}</option>
            @endforeach
          </select> --}}
          <select class="span6" name="id_kelas" id="id_kelas">
            <option value="">--Choose--</option>
          </select>
        </div>
      </div>
      <div class="control-group {{ $errors->has('id_kelas_ruang') ? 'error' : ''}}">
        <label class="control-label">Room *</label>
        <div class="controls">
          <select class="span6" name="id_kelas_ruang">
            <option value="">--Choose--</option>
            @foreach ($getKelasRuang as $key)
            <option value="{{ $key->id }}" {{ old('id_kelas_ruang') == $key->id ? 'selected=""' : ''}}>{{ $key->lantai_kelas }} | {{ $key->nama_kelas }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="control-group {{ $errors->has('hari') ? 'error' : ''}}">
        <label class="control-label">Day *</label>
        <div class="controls">
          <select class="span6" name="hari">
            <option value="">--Choose--</option>
            <option value="Sunday" {{ old('hari') == 'Sunday' ? 'selected=""' : '' }} >Sunday</option>
            <option value="Monday" {{ old('hari') == 'Monday' ? 'selected=""' : '' }} >Monday</option>
            <option value="Tuesday" {{ old('hari') == 'Tuesday' ? 'selected=""' : '' }} >Tuesday</option>
            <option value="Wednesday" {{ old('hari') == 'Wednesday' ? 'selected=""' : '' }} >Wednesday</option>
            <option value="Thursday" {{ old('hari') == 'Thursday' ? 'selected=""' : '' }} >Thursday</option>
            <option value="Friday" {{ old('hari') == 'Friday' ? 'selected=""' : '' }} >Friday</option>
            <option value="Saturday" {{ old('hari') == 'Saturday' ? 'selected=""' : '' }} >Saturday</option>
          </select>
        </div>
      </div>
      <div class="control-group {{ $errors->has('jam_mulai') ? 'error' : ''}}">
        <label class="control-label">Start *</label>
        <div class="controls">
          <select class="span6" name="jam_mulai">
            <option value="">--Choose--</option>
            <option value="08:00" {{ old('jam_mulai') == '08:00' ? 'selected=""' : '' }}>08:00</option>
            <option value="08:30" {{ old('jam_mulai') == '08:30' ? 'selected=""' : '' }}>08:30</option>
            <option value="09:00" {{ old('jam_mulai') == '09:00' ? 'selected=""' : '' }}>09:00</option>
            <option value="09:30" {{ old('jam_mulai') == '09:30' ? 'selected=""' : '' }}>09:30</option>
            <option value="10:00" {{ old('jam_mulai') == '10:00' ? 'selected=""' : '' }}>10:00</option>
            <option value="10:30" {{ old('jam_mulai') == '10:30' ? 'selected=""' : '' }}>10:30</option>
            <option value="11:00" {{ old('jam_mulai') == '11:00' ? 'selected=""' : '' }}>11:00</option>
            <option value="11:30" {{ old('jam_mulai') == '11:30' ? 'selected=""' : '' }}>11:30</option>
            <option value="12:00" {{ old('jam_mulai') == '12:00' ? 'selected=""' : '' }}>12:00</option>
            <option value="12:30" {{ old('jam_mulai') == '12:30' ? 'selected=""' : '' }}>12:30</option>
            <option value="13:00" {{ old('jam_mulai') == '13:00' ? 'selected=""' : '' }}>13:00</option>
            <option value="13:30" {{ old('jam_mulai') == '13:30' ? 'selected=""' : '' }}>13:30</option>
            <option value="14:00" {{ old('jam_mulai') == '14:00' ? 'selected=""' : '' }}>14:00</option>
            <option value="14:30" {{ old('jam_mulai') == '14:30' ? 'selected=""' : '' }}>14:30</option>
            <option value="15:00" {{ old('jam_mulai') == '15:00' ? 'selected=""' : '' }}>15:00</option>
            <option value="15:30" {{ old('jam_mulai') == '15:30' ? 'selected=""' : '' }}>15:30</option>
            <option value="16:00" {{ old('jam_mulai') == '16:00' ? 'selected=""' : '' }}>16:00</option>
            <option value="16:30" {{ old('jam_mulai') == '16:30' ? 'selected=""' : '' }}>16:30</option>
            <option value="17:00" {{ old('jam_mulai') == '17:00' ? 'selected=""' : '' }}>17:00</option>
            <option value="17:30" {{ old('jam_mulai') == '17:30' ? 'selected=""' : '' }}>17:30</option>
            <option value="18:00" {{ old('jam_mulai') == '18:00' ? 'selected=""' : '' }}>18:00</option>
            <option value="18:30" {{ old('jam_mulai') == '18:30' ? 'selected=""' : '' }}>18:30</option>
            <option value="19:00" {{ old('jam_mulai') == '19:00' ? 'selected=""' : '' }}>19:00</option>
            <option value="19:30" {{ old('jam_mulai') == '19:30' ? 'selected=""' : '' }}>19:30</option>
            <option value="20:00" {{ old('jam_mulai') == '20:00' ? 'selected=""' : '' }}>20:00</option>
            <option value="20:30" {{ old('jam_mulai') == '20:30' ? 'selected=""' : '' }}>20:30</option>
            <option value="21:00" {{ old('jam_mulai') == '21:00' ? 'selected=""' : '' }}>21:00</option>
            <option value="21:30" {{ old('jam_mulai') == '21:30' ? 'selected=""' : '' }}>21:30</option>
            <option value="22:00" {{ old('jam_mulai') == '22:00' ? 'selected=""' : '' }}>22:00</option>
            <option value="22:30" {{ old('jam_mulai') == '22:30' ? 'selected=""' : '' }}>22:30</option>
            <option value="23:00" {{ old('jam_mulai') == '23:00' ? 'selected=""' : '' }}>23:00</option>
            <option value="23:30" {{ old('jam_mulai') == '23:30' ? 'selected=""' : '' }}>23:30</option>
          </select>
        </div>
      </div>
      <div class="control-group {{ $errors->has('jam_akhir') ? 'error' : ''}}">
        <label class="control-label">End *</label>
        <div class="controls">
          <select class="span6" name="jam_akhir">
            <option value="">--Choose--</option>
            <option value="08:00" {{ old('jam_akhir') == '08:00' ? 'selected=""' : '' }}>08:00</option>
            <option value="08:30" {{ old('jam_akhir') == '08:30' ? 'selected=""' : '' }}>08:30</option>
            <option value="09:00" {{ old('jam_akhir') == '09:00' ? 'selected=""' : '' }}>09:00</option>
            <option value="09:30" {{ old('jam_akhir') == '09:30' ? 'selected=""' : '' }}>09:30</option>
            <option value="10:00" {{ old('jam_akhir') == '10:00' ? 'selected=""' : '' }}>10:00</option>
            <option value="10:30" {{ old('jam_akhir') == '10:30' ? 'selected=""' : '' }}>10:30</option>
            <option value="11:00" {{ old('jam_akhir') == '11:00' ? 'selected=""' : '' }}>11:00</option>
            <option value="11:30" {{ old('jam_akhir') == '11:30' ? 'selected=""' : '' }}>11:30</option>
            <option value="12:00" {{ old('jam_akhir') == '12:00' ? 'selected=""' : '' }}>12:00</option>
            <option value="12:30" {{ old('jam_akhir') == '12:30' ? 'selected=""' : '' }}>12:30</option>
            <option value="13:00" {{ old('jam_akhir') == '13:00' ? 'selected=""' : '' }}>13:00</option>
            <option value="13:30" {{ old('jam_akhir') == '13:30' ? 'selected=""' : '' }}>13:30</option>
            <option value="14:00" {{ old('jam_akhir') == '14:00' ? 'selected=""' : '' }}>14:00</option>
            <option value="14:30" {{ old('jam_akhir') == '14:30' ? 'selected=""' : '' }}>14:30</option>
            <option value="15:00" {{ old('jam_akhir') == '15:00' ? 'selected=""' : '' }}>15:00</option>
            <option value="15:30" {{ old('jam_akhir') == '15:30' ? 'selected=""' : '' }}>15:30</option>
            <option value="16:00" {{ old('jam_akhir') == '16:00' ? 'selected=""' : '' }}>16:00</option>
            <option value="16:30" {{ old('jam_akhir') == '16:30' ? 'selected=""' : '' }}>16:30</option>
            <option value="17:00" {{ old('jam_akhir') == '17:00' ? 'selected=""' : '' }}>17:00</option>
            <option value="17:30" {{ old('jam_akhir') == '17:30' ? 'selected=""' : '' }}>17:30</option>
            <option value="18:00" {{ old('jam_akhir') == '18:00' ? 'selected=""' : '' }}>18:00</option>
            <option value="18:30" {{ old('jam_akhir') == '18:30' ? 'selected=""' : '' }}>18:30</option>
            <option value="19:00" {{ old('jam_akhir') == '19:00' ? 'selected=""' : '' }}>19:00</option>
            <option value="19:30" {{ old('jam_akhir') == '19:30' ? 'selected=""' : '' }}>19:30</option>
            <option value="20:00" {{ old('jam_akhir') == '20:00' ? 'selected=""' : '' }}>20:00</option>
            <option value="20:30" {{ old('jam_akhir') == '20:30' ? 'selected=""' : '' }}>20:30</option>
            <option value="21:00" {{ old('jam_akhir') == '21:00' ? 'selected=""' : '' }}>21:00</option>
            <option value="21:30" {{ old('jam_akhir') == '21:30' ? 'selected=""' : '' }}>21:30</option>
            <option value="22:00" {{ old('jam_akhir') == '22:00' ? 'selected=""' : '' }}>22:00</option>
            <option value="22:30" {{ old('jam_akhir') == '22:30' ? 'selected=""' : '' }}>22:30</option>
            <option value="23:00" {{ old('jam_akhir') == '23:00' ? 'selected=""' : '' }}>23:00</option>
            <option value="23:30" {{ old('jam_akhir') == '23:30' ? 'selected=""' : '' }}>23:30</option>
          </select>
        </div>
      </div>
      <div class="form-actions">
        <input type="submit" value="Submit" class="btn btn-success">
      </div>
    </form>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
  $('input[type=checkbox],input[type=radio],input[type=file]').uniform();
  $("#basic_validate").validate({
    ignore: [],
    rules:{
      id_member:{
        required:true,
      },
      id_kelas_ruang:{
        required:true,
      },
      hari:{
        required:true,
      },
      jam_mulai:{
        required:true,
      },
      jam_akhir:{
        required:true,
      },
    },
    errorClass: "help-inline",
    errorElement: "span",
    highlight:function(element, errorClass, validClass) {
      $(element).parents('.control-group').addClass('error');
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).parents('.control-group').removeClass('error');
      $(element).parents('.control-group').addClass('success');
    }
  });


  $(document).ready(function() {
    $('select[name="id_member"]').on('change', function() {
      var idMember = $(this).val();
      if(idMember) {
          $.ajax({
              url: '{{ url('/') }}/admin/schedule/class-member/getClass/'+idMember,
              type: "GET",
              dataType: "json",

              success:function(data) {
                $('select[name="id_kelas"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="id_kelas"]').append('<option value="'+ value +'">'+ key +'</option>');
                });
              }
          });
      }else{
          $('select[name="jumlah_pembiayaan"]').empty();
      }
    });
  });
</script>
@endsection
