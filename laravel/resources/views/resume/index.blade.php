@extends('layouts.with_navbar')

@section('content')
    <style>
        legend {
            padding-top: 30px;
            margin-bottom: 5px;
        }
        .content {
            margin-left: -25px;
        }
        .primary-color {
            color: #6fa8dc
        }
    </style>

    <div class="row">
        <div class="col-sm-4 text-left">
            <h1 class="primary-color">张思浩</h1>
        </div>
        <div class="col-sm-4 text-center">
        </div>
        <div class="col-sm-4 text-right">
            <br>
            <h4 class="primary-color">求职意向：后端开发</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 text-left">
            <p>微信：spirit.line.523</p>
        </div>
        <div class="col-sm-4 text-center">
            <p>(+86)186-9886-3975</p>
        </div>
        <div class="col-sm-4 text-right">
            <p>spirit.line.523@gmail.com</p>
        </div>
    </div>


    <legend class="primary-color">教育背景</legend>
    <div class="row">
        <div class="col-sm-3">
            <h5>东北大学秦皇岛分校</h5>
        </div>
        <div class="col-sm-4">
            <h5>计算机科学与技术专业</h5>
        </div>
        <div class="col-sm-3">
            <h5>本科</h5>
        </div>
        <div class="col-sm-2">
            <h5>2012.09-2016.06</h5>
        </div>
    </div>
    <ul class="content">
        <li>作品《走起》获华北五省（市、自治区）及港澳台大学生移动应用开发大赛决赛二等奖</li>
        <li>作品《NEUQer》获华北五省（市、自治区）及港澳台大学生移动应用开发大赛决赛一等奖</li>
        <li>作品《e学童》获华北五省（市、自治区）及港澳台大学生移动应用开发大赛决赛二等奖</li>
        <li>作品《NEUQ reBuy》获华北五省（市、自治区）及港澳台大学生移动应用开发大赛决赛三等奖</li>
        <li>作品《加气助理》获华北五省（市、自治区）及港澳台大学生移动应用开发大赛决赛二等奖</li>
        <li>作品《NEUQer》获第二届全国高校移动互联网应用开发创新大赛全国三等奖</li>
        <li>作品《e学童》获第二届全国高校移动互联网应用开发创新大赛全国三等奖</li>
        <li>作品《狗带》获清华创客挑战赛第二名</li>
        <li>CET6，流畅阅读英文文档</li>
    </ul>


    <legend class="primary-color">IT技能</legend>
    <div class="row">
        <div class="col-sm-6">
            <ul class="content">
                <li>计算机语言：Java/PHP/Node.JS/C++</li>
                <li>PHP框架：Phalcon/Slim/Laravel</li>
                <li>Java框架：Spring/SpringMVC/Mybatis</li>
                <li>其他语言框架：Express.JS/jQuery/Angular.JS</li>
            </ul>
        </div>
        <div class="col-sm-6">
            <ul class="content">
                <li>DBMS：MySQL/MongoDB/Redis</li>
                <li>嵌入式开发：AVR/ZStack/uIP</li>
                <li>云计算：OpenStack/vSphere/oVirt/Ceph</li>
            </ul>
        </div>
    </div>


    <legend class="primary-color">软件开发相关经历</legend>
    <div class="row">
        <div class="col-sm-4">
            <h5>比赛项目《走起》</h5>
        </div>
        <div class="col-sm-6">
            <h5>iOS主程</h5>
        </div>
        <div class="col-sm-2">
            2014.10
        </div>
    </div>
    <ul class="content">
        <li>在两周的时间内学习Objective-C并应用于项目开发</li>
        <li>与队友通过Github协作在两周内完成产品原型的开发，各自完成一半工作量</li>
    </ul>

    <div class="row">
        <div class="col-sm-4">
            <h5>某初创O2O服务平台外包</h5>
        </div>
        <div class="col-sm-6">
            <h5>独立开发后端、架构</h5>
        </div>
        <div class="col-sm-2">
            <h5>2015.02-2015.06</h5>
        </div>
    </div>
    <ul class="content">
        <li>学习应用Phalcon开发Web全站及REST API</li>
        <li>第一次在项目中应用MongoDB</li>
    </ul>

    <div class="row">
        <div class="col-sm-4">
            <h5>某初创幼教服务平台外包</h5>
        </div>
        <div class="col-sm-6">
            <h5>独立开发后端、架构、Android主程、项目管理</h5>
        </div>
        <div class="col-sm-2">
            <h5>2015.03-2015.06</h5>
        </div>
    </div>
    <ul class="content">
        <li>学习应用Node.JS+express.js开发Web全站及REST API</li>
        <li>再次在项目中应用MongoDB</li>
        <li>第一次开发产品级Android应用</li>
    </ul>

    <div class="row">
        <div class="col-sm-4">
            <h5>自主创业项目NEUQer</h5>
        </div>
        <div class="col-sm-6">
            <h5>独立开发后端、架构、独立开发Android、项目管理、团队领袖</h5>
        </div>
        <div class="col-sm-2">
            2015.07-2016.04
        </div>
    </div>
    <ul class="content">
        <li>分别使用Node.JS及Java实践了微服务架构</li>
        <li>学习应用Java开发移动应用后端REST API</li>
        <li>学习并应用Dubbo分布式框架</li>
        <li>第一次经历Android应用从开发到发布、更新维护的全流程</li>
        <li>开发微信第三方平台</li>
    </ul>

    <div class="row">
        <div class="col-sm-4">
            <h5>比赛项目《加气助理》</h5>
        </div>
        <div class="col-sm-6">
            <h5>独立开发后端</h5>
        </div>
        <div class="col-sm-2">
            <h5>2015.10</h5>
        </div>
    </div>
    <ul class="content">
        <li>应用Spring+SpringMVC</li>
        <li>主数据库采用MongoDB</li>
        <li>从Oracle库中导入并转换线上系统加气账单数据</li>
        <li>快速开发(3天)</li>
    </ul>

    <div class="row">
        <div class="col-sm-4">
            <h5>比赛项目《NEUQ reBuy》</h5>
        </div>
        <div class="col-sm-6">
            <h5>独立开发后端</h5>
        </div>
        <div class="col-sm-2">
            <h5>2015.10</h5>
        </div>
    </div>
    <ul class="content">
        <li>应用Spring+SpringMVC+Mybatis+MySQL</li>
        <li>快速开发(4天)</li>
    </ul>

    <div class="row">
        <div class="col-sm-4">
            <h5>清华创客挑战赛《狗带》</h5>
        </div>
        <div class="col-sm-6">
            <h5>整体方案、硬件开发</h5>
        </div>
        <div class="col-sm-2">
            2015.10
        </div>
    </div>
    <ul class="content">
        <li>使用Arduino进行智能穿戴设备原型搭建与开发</li>
        <li>48小时内完成可演示原型的搭建与开发，包含硬件和Android客户端</li>
    </ul>

    <legend class="primary-color">其他经历</legend>
    <div class="row">
        <div class="col-sm-5">
            <h5>东北大学秦皇岛分校计算机与通信工程学院团委学生会</h5>
        </div>
        <div class="col-sm-5">
            <h5>文艺部副部长</h5>
        </div>
        <div class="col-sm-2">
            <h5>2013.09-2014.06</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h5>东北大学秦皇岛分校“骑乐无穷”骑行社</h5>
        </div>
        <div class="col-sm-5">
            <h5>理事长</h5>
        </div>
        <div class="col-sm-2">
            <h5>2013.09-2014.06</h5>
        </div>
    </div>

    <legend class="primary-color">特长爱好</legend>
    <p>
        业余时间喜欢骑行，有过自行车旅行经历，喜欢旅行，喜欢精致生活
    </p>
    <p>
        生性喜好钻研，喜欢实验新技术，乐于写程序。十分喜爱动手、创造。
    </p>

@endsection