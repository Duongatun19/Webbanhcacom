<div class="title-popup"><span><i class="fa fa-headphones" aria-hidden="true"></i> Yêu cầu tư vấn</span></div>
<div class="content-popup">
    <form action="{{route('postcontact')}}" method="POST">
    @csrf
    <div class="form_tuvans">
        <div class="form_tuvan">
        <input type="text"  placeholder="Họ và tên *" name="name" id="contact_name">
        </div>
        <div class="form_tuvan">
        <input type="text"  placeholder="Số điện thoại *" name="phone" id="contact_tel">
        </div>
        <div class="form_tuvan">
        <input type="text"  placeholder="Email " name="email" id="contact_email">
        </div>
        <div class="form_tuvan">
        <textarea name="mess" cols="30" rows="2" placeholder="Nội dung yêu cầu tư vấn" id="contact_email"></textarea>
        </div>
        <div style="text-align: center;">
        <input type="submit" class="btn btn-yellows tracking-tuvan" value="Gửi liên hệ" style="cursor:pointer;">
        </div>
    </div>
    </form>
</div>


