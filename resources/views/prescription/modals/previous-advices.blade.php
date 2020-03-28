<div class="modal fade right" id="previous-advices-modal" tabindex="-1" role="dialog" aria-labelledby="previous-advices-modal-label"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-info modal-lg" role="document">
        <!--Content-->
        {{--<form action="{{ url('admin/department/update') }}"  method="post" accept-charset="utf-8">--}}
            {{--{{ csrf_field() }}--}}

            <div class="modal-content">
                <!--Header-->
                <div class="modal-header" style="background-color: #17A2B8;">
                    <p class="heading">New Division
                    </p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <div class="modal-body">

                    <div class="wrapper">
                        <ul class="tabs clearfix" data-tabgroup="first-tab-group">
                            <li><a href="#tab1" class="active">Medicine</a></li>
                            <li><a href="#tab2">Investigation</a></li>
                            <li><a href="#tab3">Advice</a></li>
                        </ul>
                        <section id="first-tab-group" class="tabgroup">
                            <div id="tab1">
                                <h2>Medicines</h2>

                                <table class="table table-striped table-bordered" id="medicine-table">
                                    <thead>
                                        <th>Name</th>
                                        <th>Dose</th>
                                        <th>Duration</th>
                                        <th>Instruction</th>
                                    </thead>
                                    <tbody>
                                        <tr>

                                        </tr>
                                    </tbody>

                                </table>


                            </div>
                            <div id="tab2">
                                <h2>Investigations</h2>

                                <table class="table table-striped table-bordered" id="invest-table">
                                    <thead>
                                        <th>Investigation</th>
                                        <th>Instruction</th>
                                    </thead>
                                    <tbody>
                                        <tr>

                                        </tr>
                                    </tbody>

                                </table>

                            </div>
                            <div id="tab3">
                                <h2>Advice</h2>


                                <table class="table table-striped table-bordered" id="advice-table">
                                    <thead>
                                        <th>Advice</th>
                                    </thead>
                                    <tbody>
                                        <tr>

                                        </tr>
                                    </tbody>

                                </table>

                            </div>
                        </section>
                    </div>

                </div>

                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    {{--<button type="submit" class="btn btn-primary">Save</button>--}}
                    <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
                </div>

            </div>
            <!--/.Content-->
        {{--</form>--}}
    </div>
</div>
<!-- Modal: modalAbandonedCart-->

<script>

    $('.tabgroup > div').hide();
    $('.tabgroup > div:first-of-type').show();
    $('.tabs a').click(function(e){
        e.preventDefault();
        var $this = $(this),
            tabgroup = '#'+$this.parents('.tabs').data('tabgroup'),
            others = $this.closest('li').siblings().children('a'),
            target = $this.attr('href');
        others.removeClass('active');
        $this.addClass('active');
        $(tabgroup).children('div').hide();
        $(target).show();

    })

</script>