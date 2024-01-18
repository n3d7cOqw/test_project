@extends("layouts.header")
@yield("body")
<section class="gradient-custom">
    <div class="row d-flex justify-content-center mt-2">
        <div class="col-md-12 col-lg-10 col-xl-8">
            <div class="card">
                <div class="card-body p-4">
                    <div class="col">
                        <div class="alert alert-secondary ">
                                    <span><img class="rounded-circle shadow-1-strong me-3"
                                               src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
                                               alt="avatar" width="65"
                                               height="65"/></span>
                            <span class="">{{ $post->name . " "
                                . \Carbon\Carbon::parse($post->created_at)->format("d.m.Y") . " в "
                                . \Carbon\Carbon::parse($post->created_at)->format("H:i")}}</span>

                        </div>
                        <div>
                            <p class="small mb-0 display-5 " style="font-size: 16">
                                {{$post->text}}
                            </p>
                        </div>
                        @auth()
                            <form action="{{route("comments.store")}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mt-2">
                                    <label for="comment"><h4>Добавить комментарий</h4></label>
                                    <textarea class="form-control mb-2" id="comment" name="text" rows="3"></textarea>

                                    <label for="captcha">Введите капчу</label>
                                    <p> {!!captcha_img() !!}  </p>
                                    <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha"
                                           name="captcha">
                                    <input type="file" name="picture">
                                    <button type="submit" class="btn btn-primary mb-2 mt-2">Отправить комментарий</button>
                                </div>
                            </form>
                            @error('captcha')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            @if(session("success"))
                                <div class="alert alert-primary" role="alert">
                                    {{session("success")}}
                                </div>
                            @endif
                        @endauth
                        <h4 class="text-center mb-4 pb-2">Комметарии: {{$comments->total()}}</h4>


                        <form action="{{route("comments.index")}}" method="get">
                            <div class="btn-group pb-2 d-flex justify-content-center " role="group">
                                <input type="submit" value="От первого до последнего" name="date_asc"
                                       class="btn btn-success mr-2">
                                <input type="submit" value="По дате добавления" name="date_desc" class="btn btn-danger ml-2 mr-2">


                                <input type="submit" value="По убыванию никнейма" name="username_desc"
                                       class="btn btn-success ml-2 mr-2">
                                <input type="submit" value="По возростанию никнейма" name="username_asc"
                                       class="btn btn-danger ml-2">
                            </div>
                        </form>
                    </div>
                    <section class="comments">
                    @foreach($comments as $comment)
                        <div class="col">
                            <div class="alert alert-secondary mt-4">
                                    <span><img class="rounded-circle shadow-1-strong me-3"
                                               src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
                                               alt="avatar" width="65"
                                               height="65"/></span>
                                <span class="">{{$comment->name . " "
                                . \Carbon\Carbon::parse($comment->created_at)->format("d.m.Y") . " в "
                                . \Carbon\Carbon::parse($comment->created_at)->format("H:i")}}</span>
                                <!-- HTML-код для кнопки -->

                            </div>
                            <div>
                                <p class="small mb-0" style="font-size: 16">
                                    {{$comment->text}}
                                </p>
                                <div>
                                    @isset($comment->photo)
                                        <img src="{{asset("storage/" . $comment->photo), false}}" alt="" >
                                    @endisset
                                </div>
                            </div>

                        </div>
                    @endforeach
                        {{$comments->withQueryString()->links()}}
                    </section>
                </div>
            </div>
        </div>
    </div>
    <label for="file-input" class="custom-file-upload">
        <i class="fas fa-cloud-upload-alt"></i> Завантажити файл
    </label>
    <input id="file-input" type="file" style="display: none;">

</section>
