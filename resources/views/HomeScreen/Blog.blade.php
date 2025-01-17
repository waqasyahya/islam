@extends('HomeScreen.Header-Layout')
<head>
    <title>islame - Blogs</title>
    <link href="/image/WIthColor_logo.png" rel="icon">
    <link href="/image/WIthColor_logo.png" rel="apple-touch-icon">
<link rel="stylesheet" href="{{ asset('/css/BlogPage.css') }}" />
 <link href="https://fonts.googleapis.com/css2?family=Readex+Pro&display=swap" rel="stylesheet">

<style>

  @media (min-width: 250px) and (max-width: 500px) {
      .waqas{
          margin-top:38px !important;
      }
 .Readexpro1{
    font-family: 'Readex Pro', sans-serif !important;
    }
}
</style>

</head>
<body>
    <script>
        AOS.init();

      </script>
      <div class="" style="margin-top: -20px;"></div>
        <div data-aos="fade-in"  style="max-width: 100%; width: 100%;">

        <div class="about-pageheading-section" style="background: linear-gradient(to top, #006d74, #02904c);height: auto; width: 100%; margin-top:70px; text-align: center; display: flex; align-items: center; justify-content: center; padding:
        0px 5px;">
            <span style="display: flex;  font-family: 'Readex Pro', sans-serif; flex-direction: column; align-items: center; font-weight: 400; font-size: 67px; color: white; line-height: 80px; padding-bottom: 40px; padding-top: 80px;" class="all-youneed-to-know-about-islam Readexpro1">
                All You Need To<br>
                <div style="font-size: 72px; font-weight: 500;font-family: 'Readex Pro', sans-serif;" class="about-page-main-heading Readexpro1">Know About Islame</div>

            </span>
        </div>

        </div>

<div class="container waqas team-box-grandparent-container"  style="margin-top: -1px; ">
    <div>

  @foreach ($data->sortByDesc('updated_at') as $blog)
      <!--first-->
      <div class="col-md-4 col-sm-4 col-xs-12 team-box-parent-container"  style=" margin-top:50px; height:auto !important; border-radius:10px;"><a href="{{url('/post/'.$blog->id.'/'.$blog->tittle)}}" style="text-decoration: none; color: black;font-family: 'Readex Pro', sans-serif; ">
        <div class="card shadow-lg">
        <div class="team-boxes" style="border: #02904C; border-radius: 40px;">

            <div class="team-thumb overlay-image view-overlay" style="width:100%;border:#eee solid;border-radius:1px; height:220px; border-radius:10px; margin-right: -100px;box-sizing: border-box;">

                <img src="{{asset('/BlogImage/'.$blog->image)}}" alt="not found" style="width: 100% !important; height: 220px; ">

                <div class="clear">
                </div>
                <div class="mask team_quote">
                    <div class="port-zoom-link">
                        <p>
                            <span class="accentcolor Readexpro1" style="font-weight:700; font-family: 'Readex Pro', sans-serif; "></span>
                            <br>
                            <i>{{$blog->underdecsription}}</i>
                        </p>
                    </div>
                </div>
            </div>
            </h3>
            <div class="team-info">
                <h2 class="Readexpro1" style="margin-top: 20px; border-bottom:#FFF; font-family: 'Readex Pro', sans-serif; ">{{$blog->tittle}}</h2>
                <p class="Readexpro1" style="margin-left: 0px;margin-top:-30px; font-size: 15px; font-family: 'Readex Pro', sans-serif; ">
                    {{$blog->Description}}
                </p>
            </div>


            <div class="team-social">
              <button class="btn Readexpro1" style="margin-left: 5px; height: 50px; width: 100px;font-size:16px; background-color:#fff;  color:#006D74;font-family: 'Readex Pro', sans-serif; ">Read More>></button>
            </div>
            <hr>
            <h3 class="Readexpro1" style="margin-left: 10px; font-size: 16px;margin-top:20px; color:#8f8b8b;font-family: 'Readex Pro', sans-serif; "> {{$blog->created_at->englishMonth}}  {{ $blog->created_at->format('d,Y ') }}.No Comments </h3>

        </div>
    </div>
       </a>
    </div>

 @endforeach

    </div>

  </div>
  </div>






  {{-- pagination --}}

  <div class="container " >
    <div class="row">
<div class="col-5"></div>
<div class="col-4" style="margin-top: 50px;" >
    <nav aria-label="Page navigation example" >
        <ul class="pagination">

            <li class="page-item" id="previous-page">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="2">2</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="3">3</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="4">4</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="4">5</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="4">6</a></li>
            <li class="page-item" id="next-page">

                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>

        </ul>
    </nav>
</div>
<div class="col-3"></div>
</div>

    </div>

  {{-- pagination --}}

@include('HomeScreen.Footer-Layout')

<script>
const cardsPerPage = 9; // Number of cards to display per page
const cardContainer = document.querySelector('.card-container');
const pageLinksContainer = document.querySelector('.pagination');

// Function to show the cards for a specific page
function showPage(pageNumber) {
    const startIndex = (pageNumber - 1) * cardsPerPage;
    const endIndex = startIndex + cardsPerPage;
    const cards = document.querySelectorAll('.col-md-4');

    cards.forEach((card, index) => {
        if (index >= startIndex && index < endIndex) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

showPage(1);

// Function to create pagination links
function createPaginationLinks() {
    const totalCards = document.querySelectorAll('.col-md-4').length;
    const totalPages = Math.ceil(totalCards / cardsPerPage);

    let paginationLinks = '';

    for (let i = 1; i <= totalPages; i++) {
        paginationLinks += `
            <li class="page-item"><a class="page-link" href="#" data-page="${i}">${i}</a></li>
        `;
    }

    pageLinksContainer.innerHTML = `
        <li class="page-item" id="previous-page">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        ${paginationLinks}
        <li class="page-item" id="next-page">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    `;

    pageLinksContainer.querySelectorAll('.page-link[data-page]').forEach(pageLink => {
        pageLink.addEventListener('click', (e) => {
            e.preventDefault();
            const pageNumber = parseInt(pageLink.getAttribute('data-page'));
            showPage(pageNumber);
        });
    });
}

// Create pagination links
createPaginationLinks();

// Add click event listeners to "Previous" and "Next" buttons
const previousPageButton = document.getElementById('previous-page');
const nextPageButton = document.getElementById('next-page');

previousPageButton.addEventListener('click', (e) => {
    e.preventDefault();
    const activePage = document.querySelector('.page-link.active');
    if (activePage) {
        const pageNumber = parseInt(activePage.getAttribute('data-page'));
        if (pageNumber > 1) {
            showPage(pageNumber - 1);
        }
    }
});

nextPageButton.addEventListener('click', (e) => {
    e.preventDefault();
    const activePage = document.querySelector('.page-link.active');
    if (activePage) {
        const pageNumber = parseInt(activePage.getAttribute('data-page'));
        if (pageNumber < totalPages) {
            showPage(pageNumber + 1);
        }
    }
});
</script>
</body>
</html>
