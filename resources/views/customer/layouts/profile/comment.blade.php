<section class="write-review container-fluid">
    <div class="row">
        <div class="col-12 title">
            <div class="title__one">
                <span>@lang('customer.send_review')</span>
            </div>
        </div>
        <form action="{{ route('customer.review', $id) }}" method="post">
            <div class="col-12 box">
                @csrf
                <div class="box__rating rating">
                    <i class="fa fa-star" data-rate="1"></i>
                    <i class="fa fa-star" data-rate="2"></i>
                    <i class="fa fa-star" data-rate="3"></i>
                    <i class="fa fa-star" data-rate="4"></i>
                    <i class="fa fa-star" data-rate="5"></i>
                    <input type="hidden" id="rating-count" name="rating" value="5">
                </div>
                <div class="box__input">
                    <div class="box__input-label"><span>@lang('customer.title')</span></div>
                    <div class="box__input-item">
                        <input type="text" name="description" class="form-control" />
                    </div>
                </div>
                <div class="box__input">
                    <div class="box__input-label">@lang('customer.comment')</div>
                    <div class="box__input-item">
                        <textarea rows="3" type="text" name="comment" class="form-control"> </textarea>
                    </div>
                </div>
                <div class="box__btn">
                    <button class="btn" type="submit">@lang('customer.send_review')</button>
                </div>
            </div>
        </form>
    </div>
</section>
