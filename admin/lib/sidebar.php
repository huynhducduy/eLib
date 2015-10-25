<!-- BEGIN SIDEBAR -->
<?php
switch ($_SERVER['PHP_SELF'])
{
	case '/admin/dash.php': $active=1; break;
	case '/admin/basic.php': $active=2; break;
	case '/admin/info.php': $active=3; break;
	case '/admin/social.php': $active=4; break;
	case '/admin/slide.php': $active=5; break;
	case '/admin/borrow.php': $active=6; break;
	case '/admin/subscriber.php': $active=7; break;
	case '/admin/cate-list.php': $active=8; break;
	case '/admin/cate-edit.php': $active=8; break;
	case '/admin/cate-create.php': $active=9; break;
	case '/admin/book-list.php': $active=10; break;
	case '/admin/book-edit.php': $active=10; break;
	case '/admin/book-create.php': $active=11; break;
	case '/admin/comment-list.php': $active=12; break;
	case '/admin/comment-edit.php': $active=12; break;
	case '/admin/review-list.php': $active=13; break;
	case '/admin/review-edit.php': $active=13; break;
	case '/admin/request-list.php': $active=14; break;
	case '/admin/request-view.php': $active=14; break;
	case '/admin/contribute-list.php': $active=15; break;
	case '/admin/contribute-view.php': $active=15; break;
	case '/admin/user-list.php': $active=16; break;
	case '/admin/user-edit.php': $active=16; break;
	case '/admin/order-list.php': $active=17; break;
	case '/admin/order-view.php': $active=17; break;
	case '/admin/problem-list.php': $active=18; break;
	case '/admin/problem-edit.php': $active=18; break;
	case '/admin/add-problem.php': $active=19; break;
} 
?>
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="start <?php if (in_array($active,[1])) echo 'active'; ?>">
					<a href="dash.php">
					<i class="icon-home"></i>
					<span class="title"> Dashboard</span>
					</a>
				</li>
				<li class="<?php if (in_array($active,[2,3,4,5,6,7])) echo 'active open'; ?>">
					<a href="javascript:;">
					<i class="icon-settings"></i>
					<span class="title"> Thiết lập</span>
					<span class="arrow <?php if (in_array($active,[2,3,4,5,6,7])) echo 'open'; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if (in_array($active,[2])) echo 'active'; ?>">
							<a href="basic.php">
							<i class="icon-equalizer"></i> Cơ bản</a>
						</li>
						<li class="<?php if (in_array($active,[3])) echo 'active'; ?>">
							<a href="info.php">
							<i class="icon-wrench"></i> Chi tiết</a>
						</li>
						<li class="<?php if (in_array($active,[4])) echo 'active'; ?>">
							<a href="social.php">
							<i class="icon-social-facebook"></i> Xã hội</a>
						</li>
						<li class="<?php if (in_array($active,[5])) echo 'active'; ?>">
							<a href="slide.php">
							<i class="icon-camera"></i> Trình chiếu ảnh</a>
						</li>
						<li class="<?php if (in_array($active,[6])) echo 'active'; ?>">
							<a href="borrow.php">
							<i class="icon-folder"></i> Mượn sách</a>
						</li>
						<li class="<?php if (in_array($active,[7])) echo 'active'; ?>">
							<a href="subscriber.php">
							<i class="icon-heart"></i> Danh sách theo dõi</a>
						</li>
					</ul>
				</li>
				<li class="<?php if (in_array($active,[8,9])) echo 'active open'; ?>">
					<a href="javascript:;">
					<i class="icon-folder-alt"></i>
					<span class="title"> Danh mục sách</span>
					<span class="arrow <?php if (in_array($active,[8,9])) echo 'open'; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if (in_array($active,[8])) echo 'active'; ?>">
							<a href="cate-list.php">
							<i class="icon-list"></i> Danh sách</a>
						</li>
						<li class="<?php if (in_array($active,[9])) echo 'active'; ?>">
							<a href="cate-create.php">
							<i class="icon-note"></i> Thêm danh mục</a>
						</li>
					</ul>
				</li>
				<li class="<?php if (in_array($active,[10,11,12,13,14,15])) echo 'active open'; ?>">
					<a href="javascript:;">
					<i class="icon-book-open"></i>
					<span class="title"> Sách</span>
					<span class="arrow <?php if (in_array($active,[10,11,12,13,14,15])) echo 'open'; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if (in_array($active,[10])) echo 'active'; ?>">
							<a href="book-list.php">
							<i class="icon-list"></i> Danh sách</a>
						</li>
						<li class="<?php if (in_array($active,[11])) echo 'active'; ?>">
							<a href="book-create.php">
							<i class="icon-note"></i> Thêm sách</a>
						</li>
						<li class="<?php if (in_array($active,[12])) echo 'active'; ?>">
							<a href="comment-list.php">
							<i class="icon-bubbles"></i> Bình luận</a>
						</li>
						<li class="<?php if (in_array($active,[13])) echo 'active'; ?>">
							<a href="review-list.php">
							<i class="icon-cursor"></i> Nhận xét</a>
						</li>
						<li class="<?php if (in_array($active,[14])) echo 'active'; ?>">
							<a href="request-list.php">
							<i class="icon-hourglass"></i> Yêu cầu sách</a>
						</li>
						<li class="<?php if (in_array($active,[15])) echo 'active'; ?>">
							<a href="contribute-list.php">
							<i class="icon-badge"></i> Đóng góp sách</a>
						</li>
					</ul>
				</li>
				<li class="<?php if (in_array($active,[16])) echo 'active'; ?>">
					<a href="user-list.php">
					<i class="icon-users"></i>
					<span class="title"> Tài khoản</span>
					</a>
				</li>
				<li class="<?php if (in_array($active,[17])) echo 'active'; ?>">
					<a href="order-list.php">
					<i class="icon-basket"></i>
					<span class="title"> Đơn sách</span>
					</a>
				</li>
				<li class="<?php if (in_array($active,[18,19])) echo 'active open'; ?>">
					<a href="javascript:;">
					<i class="icon-wrench"></i>
					<span class="title"> Vấn đề phát sinh</span>
					<span class="arrow <?php if (in_array($active,[18,19])) echo 'open'; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if (in_array($active,[18])) echo 'active'; ?>">
							<a href="problem-list.php">
							<i class="icon-list"></i> Danh sách</a>
						</li>
						<li class="<?php if (in_array($active,[19])) echo 'active'; ?>">
							<a href="add-problem.php">
							<i class="icon-note"></i> Thêm vấn đề</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:adminLogout()">
					<i class="icon-logout"></i>
					<span class="title"> Đăng xuất</span>
					</a>
				</li>
			</ul>
		</div>
	</div>