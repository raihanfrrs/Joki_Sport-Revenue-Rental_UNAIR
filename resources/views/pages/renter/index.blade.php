@extends('layouts.renter')

@section('section-renter')
<section>
    <div class="container">
         <div class="row">
              <div class="col-md-12 col-sm-12">
                   <div class="text-center">
                        <h2>Tentang Kami</h2>
                        <br>
                        <p class="lead">Kami adalah penyedia terkemuka dalam penyewaan venue olahraga dan 
                             aplikasi booking membership gym, yang bertujuan untuk memudahkan Anda dalam menjalani gaya hidup sehat. 
                             Kami menawarkan venue berkualitas dan aplikasi canggih dengan harga terjangkau, serta dukungan pelanggan
                              yang siap membantu kapan saja. Bergabunglah dengan kami sekarang untuk meraih kesehatan dan kebugaran 
                              terbaik!</p>
                   </div>
              </div>
         </div>
    </div>
</section>

<section>
    <div class="container">
         <div class="row">
              <div class="col-md-12 col-sm-12">
                   <div class="section-title text-center">
                        <h2>Rekomendasi Kami <small>Berikut beberapa rekomendasi tempat olahraga dari kami untuk anda sewa</small></h2>
                   </div>
              </div>

              @foreach ($fields as $field)
               <div class="col-md-4 col-sm-4">
                    <div class="courses-thumb courses-thumb-secondary">
                         <div class="courses-top">
                              <div class="courses-image">
                                   <img src="{{ $field->getFirstMediaUrl('field_image') }}" class="img-responsive" alt="">
                              </div>
                         </div>

                         <div class="courses-detail">
                              <h3><a href="fleet.html">{{ $field->name }}</a></h3>
                              <p class="lead"><small>Harga Sewa dari</small> <strong>@rupiah($field->gor->price)</strong> <small>per jam</small></p>
                              <p>{{ $field->name }} beralamat di {{ $field->gor->address }}</p>
                         </div>

                         <div class="courses-info">
                              <a href="{{ route('booking.field.form', $field->slug) }}" class="section-btn btn btn-primary btn-block">Book Now</a>
                         </div>

                    </div>
               </div>
              @endforeach
    </div>
</section>

<section>
    <div class="container">
         <div class="row">
              <div class="col-md-12 col-sm-12">
                   <div class="section-title text-center">
                        <h2>Latest Blog posts <small>Lorem ipsum dolor sit amet.</small></h2>
                   </div>
              </div>

              <div class="col-md-4 col-sm-4">
                   <div class="courses-thumb courses-thumb-secondary">
                   <div class="courses-thumb courses-thumb-secondary">
                             <div class="courses-top">
                                  <div class="courses-image">
                                       <img src="{{ asset('assets/img/blog-1.jpg') }}" class="img-responsive" alt="">
                                  </div>
                                  <div class="courses-date">
                                       <span title="Author"><i class="fa fa-user"></i> Corry Magdalena</span>
                                       <span title="Date"><i class="fa fa-calendar"></i> 06/12/2022</span>
                                       <span title="Views"><i class="fa fa-eye"></i>145</span>
                                  </div>
                             </div>

                             <div class="courses-detail">
                                  <h3><a href="{{url('/blog-post-details')}}">Manfaat Berolahraga Bagi Kesehatan Tubuh</a></h3>
                             </div>

                             <div class="courses-info">
                                  <a href="{{url('/blog-post-details')}}" class="section-btn btn btn-primary btn-block">Read More</a>
                             </div>
                        </div>
                   </div>
              </div>

              <div class="col-md-4 col-sm-4">
                   <div class="courses-thumb courses-thumb-secondary">
                             <div class="courses-top">
                                  <div class="courses-image">
                                       <img src="{{ asset('assets/img/blog-2.jpg') }}" class="img-responsive" alt="">
                                  </div>
                                  <div class="courses-date">
                                       <span title="Author"><i class="fa fa-user"></i> Kurnia Bahari</span>
                                       <span title="Date"><i class="fa fa-calendar"></i> 02/01/2023</span>
                                       <span title="Views"><i class="fa fa-eye"></i> 255</span>
                                  </div>
                             </div>

                             <div class="courses-detail">
                                  <h3><a href="{{url('/blog-post-details')}}">Awal Tahun Lebih Sehat, Berikut Manfaat dan Latihan Gym Pemula</a></h3>
                             </div>

                             <div class="courses-info">
                                  <a href="{{url('/blog-post-details')}}" class="section-btn btn btn-primary btn-block">Read More</a>
                             </div>
                        </div>
              </div>

              <div class="col-md-4 col-sm-4">
              <div class="courses-thumb courses-thumb-secondary">
                             <div class="courses-top">
                                  <div class="courses-image">
                                       <img src="{{ asset('assets/img/blog-5.jpeg') }}" class="img-responsive" alt="">
                                  </div>
                                  <div class="courses-date">
                                       <span title="Author"><i class="fa fa-user"></i>Mercy Raya</span>
                                       <span title="Date"><i class="fa fa-calendar"></i> 10/10/2023</span>
                                       <span title="Views"><i class="fa fa-eye"></i> 189</span>
                                  </div>
                             </div>

                             <div class="courses-detail">
                                  <h3><a href="{{url('/blog-post-details')}}">Menpora Dito: Bulutangkis Gagal di Asia Games 2023 karena...</a></h3>
                             </div>

                             <div class="courses-info">
                                  <a href="{{url('/blog-post-details')}}" class="section-btn btn btn-primary btn-block">Read More</a>
                             </div>
                        </div>
              </div>
         </div>
    </div>
</section>

<section id="testimonial">
    <div class="container">
         <div class="row">

              <div class="col-md-12 col-sm-12">
                   <div class="section-title text-center">
                        <h2>Testimoni <small>testimoni dari pelanggan kami</small></h2>
                   </div>

                   <div class="owl-carousel owl-theme owl-client">
                        <div class="col-md-4 col-sm-4">
                             <div class="item">
                                  <div class="tst-image">
                                       <img src="{{ asset('assets/img/tst-image-1-200x216.jpg') }}" class="img-responsive" alt="">
                                  </div>
                                  <div class="tst-author">
                                       <h4>Jackson</h4>
                                       <span>Shopify Developer</span>
                                  </div>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam voluptas, facilis adipisci dolorem exercitationem nemo aut error impedit repudiandae iusto.</p>
                                  <div class="tst-rating">
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                  </div>
                             </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                             <div class="item">
                                  <div class="tst-image">
                                       <img src="{{ asset('assets/img/tst-image-2-200x216.jpg') }}" class="img-responsive" alt="">
                                  </div>
                                  <div class="tst-author">
                                       <h4>Camila</h4>
                                       <span>Marketing Manager</span>
                                  </div>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente error, unde eos laborum consequatur officiis perferendis vel debitis, dolore, ipsum quibusdam culpa quisquam, reiciendis aspernatur.</p>
                                  <div class="tst-rating">
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                  </div>
                             </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                             <div class="item">
                                  <div class="tst-image">
                                       <img src="{{ asset('assets/img/tst-image-3-200x216.jpg') }}" class="img-responsive" alt="">
                                  </div>
                                  <div class="tst-author">
                                       <h4>Barbie</h4>
                                       <span>Art Director</span>
                                  </div>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit laborum minima autem, reprehenderit mollitia amet id, beatae quo sequi culpa assumenda neque a quisquam, magni.</p>
                                  <div class="tst-rating">
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                  </div>
                             </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                             <div class="item">
                                  <div class="tst-image">
                                       <img src="{{ asset('assets/img/tst-image-4-200x216.jpg') }}" class="img-responsive" alt="">
                                  </div>
                                  <div class="tst-author">
                                       <h4>Andrio</h4>
                                       <span>Web Developer</span>
                                  </div>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore natus culpa laudantium sit dolores quidem at nulla, iure atque laborum! Odit tempora, enim aliquid at modi illum ducimus explicabo soluta.</p>
                                  <div class="tst-rating">
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                  </div>
                             </div>
                        </div>

                   </div>
             </div>
         </div>
    </div>
</section> 
@endsection