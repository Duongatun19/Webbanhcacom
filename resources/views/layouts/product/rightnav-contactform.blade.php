<div class="full-box-sidebar">
    <div class="box-top-sideaber">
        <div class="nhan-bao-gia">
        <div class="logo-sidebar text-center mx-auto w-75 mt-3 mb-2">
            <img src="{{$setting->logo}}" alt="{{$setting->company}}">
        </div>
        </div>
        <div class="content-box-sidebar mb-2 text-justify p-2">
        <div class="content-box">
            {{$setting->webname}}
        </div>
        </div>
    </div>
    <div class="form-bao-gia mt-3">
        <div class="title-sidebar text-uppercase text-center font-weight-bold mb-2 p-2">Đăng ký nhận báo giá</div>
        <div role="form" class="wpcf7" id="wpcf7-f4302-p127-o1" lang="vi" dir="ltr">
        <div class="screen-reader-response" role="alert" aria-live="polite"></div>
        <form action="{{route('postcontact')}}" method="post">
            @csrf
            <p><label> Số điện thoại (bắt buộc)<br />
                <span class="wpcf7-form-control-wrap phone-number-remenber"><input type="tel" name="phone" value="" size="40" class="wpcf7-form-control " /></span> </label>
            </p>
            <p><label> Địa chỉ Email nhận thông tin<br />
                <span class="wpcf7-form-control-wrap your-email"><input type="email" name="email" value="" size="40" class="wpcf7-form-control" /></span> </label>
            </p>
            <p><label> Nội dung yêu cầu tư vấn  - báo giá<br />
                <span class="wpcf7-form-control-wrap your-message"><textarea name="mess" cols="40" rows="10" class="wpcf7-form-control"></textarea></span> </label>
            </p>
            <p><input type="submit" value="Gửi đi" class="wpcf7-form-control" /></p>
        </form>
        </div>
    </div>
</div>
<style type="text/css">
    .form-bao-gia .boxx-row .col-md-6{
    flex: 0 0 100%;
    max-width: 100%;
    }
    .full-box-sidebar{
    border: 1px dotted #b48484;
    padding: 5px 5px 15px;
    /*background: rgba(0,0,0,0.05);*/
    }
    .box-top-sideaber{
    border-bottom: 1px dotted #b48484; 
    }
    .title-sidebar{
    font-size: 20px;
    }
</style>