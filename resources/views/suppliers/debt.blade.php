@extends('layout')
@section('title', 'Công nợ nhà cung cấp')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Hi im Công nợ NCC</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>
                <!-- <div class="card-body">
                    <div class="table-content">
                        <span class="title">Table of Contents</span>
                        <ul>
                            <li>
                                <a href="#how">How it works</a>
                                <ol>
                                    <li>
                                        <a href="#nav">Nav</a>
                                    </li>
                                    <li>
                                        <a href="#forms">Forms</a>
                                    </li>
                                    <li>
                                        <a href="#text">Text</a>
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <a href="#color">
                                    Color schemes
                                </a>
                            </li>
                            <li>
                                <a href="#containers">
                                    Containers
                                </a>
                            </li>
                            <li>
                                <a href="#placement">Placement</a>
                            </li>
                            <li>
                                <a href="#responsive">Responsive behaviors</a>
                                <ol>
                                    <li>
                                        <a href="#toggler">Toggler</a>
                                    </li>
                                </ol>
                            </li>
                        </ul>
                    </div>
                    <h4 class="subcontent-title" id="how"><span>How it works</span></h4>
                    <p>Here’s what you need to know before getting started with the navbar:</p>
                    <ul>
                        <li>Navbars require a wrapping <code class="highlighter-rouge">.navbar</code> with <code class="highlighter-rouge">.navbar-expand{-sm|-md|-lg|-xl}</code> for responsive collapsing and <a href="#color-schemes">color scheme</a> classes.</li>
                        <li>Navbars and their contents are fluid by default. Use <a href="#containers">optional containers</a> to limit their horizontal width.</li>
                        <li>Use our <a href="/docs/4.0/utilities/spacing/">spacing</a> and <a href="/docs/4.0/utilities/flex/">flex</a> utility classes for controlling spacing and alignment within navbars.</li>
                        <li>Navbars are responsive by default, but you can easily modify them to change that. Responsive behavior depends on our Collapse JavaScript plugin.</li>
                        <li>Navbars are hidden by default when printing. Force them to be printed by adding <code class="highlighter-rouge">.d-print</code> to the <code class="highlighter-rouge">.navbar</code>. See the <a href="/docs/4.0/utilities/display/">display</a> utility class.</li>
                        <li>Ensure accessibility by using a <code class="highlighter-rouge">&lt;nav&gt;</code> element or, if using a more generic element such as a <code class="highlighter-rouge">&lt;div&gt;</code>, add a <code class="highlighter-rouge">role="navigation"</code> to every navbar to explicitly identify it as a landmark region for users of assistive technologies.</li>
                    </ul>
                    <p>Read on for an example and list of supported sub-components.</p>

                    <h5 id="nav">Nav</h5>
                    <p>Navbar navigation links build on our <code class="highlighter-rouge">.nav</code> options with their own modifier class and require the use of <a href="#toggler">toggler classes</a> for proper responsive styling. <strong>Navigation in navbars will also grow to occupy as much horizontal space as possible</strong> to keep your navbar contents securely aligned.</p>
                    <p>Active states—with <code class="highlighter-rouge">.active</code>—to indicate the current page can be applied directly to <code class="highlighter-rouge">.nav-link</code>s or their immediate parent <code class="highlighter-rouge">.nav-item</code>s.</p>
                    <div class="bd-example">
                        <nav class="navbar navbar-expand-lg bg-secondary">
                            <a class="navbar-brand" href="#">Navbar</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#">Disabled</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <pre class="language-markup">
                        <code class="language-markup">
                            &lt;nav class=&quot;navbar navbar-expand-lg bg-secondary&quot;&gt;
                                &lt;a class=&quot;navbar-brand&quot; href=&quot;#&quot;&gt;Navbar&lt;/a&gt;
                                &lt;button class=&quot;navbar-toggler&quot; type=&quot;button&quot; data-toggle=&quot;collapse&quot; data-target=&quot;#navbarNav&quot; aria-controls=&quot;navbarNav&quot; aria-expanded=&quot;false&quot; aria-label=&quot;Toggle navigation&quot;&gt;
                                    &lt;span class=&quot;navbar-toggler-icon&quot;&gt;&lt;/span&gt;
                                &lt;/button&gt;
                                &lt;div class=&quot;collapse navbar-collapse&quot; id=&quot;navbarNav&quot;&gt;
                                    &lt;ul class=&quot;navbar-nav&quot;&gt;
                                        &lt;li class=&quot;nav-item active&quot;&gt;
                                            &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Home &lt;span class=&quot;sr-only&quot;&gt;(current)&lt;/span&gt;&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Features&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Pricing&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot;&gt;Disabled&lt;/a&gt;
                                        &lt;/li&gt;
                                    &lt;/ul&gt;
                                &lt;/div&gt;
                            &lt;/nav&gt;
                        </code>
                    </pre>

                    <p>You may also utilize dropdowns in your navbar nav. Dropdown menus require a wrapping element for positioning, so be sure to use separate and nested elements for <code class="highlighter-rouge">.nav-item</code> and <code class="highlighter-rouge">.nav-link</code> as shown below.</p>
                    <div class="bd-example">
                        <nav class="navbar navbar-expand-lg bg-success">
                            <div class="container">
                                <a class="navbar-brand" href="#">Navbar</a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                    <ul class="navbar-nav">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Features</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Pricing</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Dropdown link
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </li>
                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <pre class="language-markup">
                        <code class="language-markup">
                            &lt;nav class=&quot;navbar navbar-expand-lg bg-success&quot;&gt;
                                &lt;div class=&quot;container&quot;&gt;
                                    &lt;a class=&quot;navbar-brand&quot; href=&quot;#&quot;&gt;Navbar&lt;/a&gt;
                                    &lt;button class=&quot;navbar-toggler&quot; type=&quot;button&quot; data-toggle=&quot;collapse&quot; data-target=&quot;#navbarNavDropdown&quot; aria-controls=&quot;navbarNavDropdown&quot; aria-expanded=&quot;false&quot; aria-label=&quot;Toggle navigation&quot;&gt;
                                        &lt;span class=&quot;navbar-toggler-icon&quot;&gt;&lt;/span&gt;
                                    &lt;/button&gt;
                                    &lt;div class=&quot;collapse navbar-collapse&quot; id=&quot;navbarNavDropdown&quot;&gt;
                                        &lt;ul class=&quot;navbar-nav&quot;&gt;
                                            &lt;li class=&quot;nav-item active&quot;&gt;
                                                &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Home &lt;span class=&quot;sr-only&quot;&gt;(current)&lt;/span&gt;&lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;nav-item&quot;&gt;
                                                &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Features&lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;nav-item&quot;&gt;
                                                &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Pricing&lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;nav-item dropdown&quot;&gt;
                                                &lt;a class=&quot;nav-link dropdown-toggle&quot; href=&quot;#&quot; id=&quot;navbarDropdownMenuLink&quot; data-toggle=&quot;dropdown&quot; aria-haspopup=&quot;true&quot; aria-expanded=&quot;false&quot;&gt;
                                                    Dropdown link
                                                &lt;/a&gt;
                                                &lt;div class=&quot;dropdown-menu&quot; aria-labelledby=&quot;navbarDropdownMenuLink&quot;&gt;
                                                    &lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Action&lt;/a&gt;
                                                    &lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Another action&lt;/a&gt;
                                                    &lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Something else here&lt;/a&gt;
                                                &lt;/div&gt;
                                            &lt;/li&gt;
                                        &lt;/ul&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/nav&gt;
                        </code>
                    </pre>

                    <h5 id="forms">Forms</h5>
                    <p>You can add search form to Navbar:</p>
                    <div class="bd-example">
                        <nav class="navbar navbar-light bg-primary justify-content-between">
                            <a class="navbar-brand">Navbar</a>
                            <form class="navbar-left navbar-form nav-search" action="">
                                <div class="input-group">
                                    <input type="text" placeholder="Search ..." class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-search search-icon"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </nav>
                    </div>
                    <pre class="language-markup">
                        <code class="language-markup">
                            &lt;nav class=&quot;navbar navbar-light bg-primary justify-content-between&quot;&gt;
                                &lt;a class=&quot;navbar-brand&quot;&gt;Navbar&lt;/a&gt;
                                &lt;form class=&quot;navbar-left navbar-form nav-search&quot; action=&quot;&quot;&gt;
                                    &lt;div class=&quot;input-group&quot;&gt;
                                        &lt;input type=&quot;text&quot; placeholder=&quot;Search ...&quot; class=&quot;form-control&quot;&gt;
                                        &lt;div class=&quot;input-group-append&quot;&gt;
                                            &lt;span class=&quot;input-group-text&quot;&gt;
                                                &lt;i class=&quot;fa fa-search search-icon&quot;&gt;&lt;/i&gt;
                                            &lt;/span&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;
                                &lt;/form&gt;
                            &lt;/nav&gt;
                        </code>
                    </pre>

                    <h5 id="text">Text</h5>
                    <p>Navbars may contain bits of text with the help of <code class="highlighter-rouge">.navbar-text</code>. This class adjusts vertical alignment and horizontal spacing for strings of text.</p>
                    <div class="bd-example">
                        <nav class="navbar navbar-dark bg-primary">
                            <div class="container">
                                <span class="navbar-text">
                                    Navbar text with an inline element
                                </span>
                            </div>
                        </nav>
                    </div>
                    <pre class="language-markup">
                        <code class="language-markup">
                            &lt;nav class=&quot;navbar navbar-dark bg-primary&quot;&gt;
                                &lt;div class=&quot;container&quot;&gt;
                                    &lt;span class=&quot;navbar-text&quot;&gt;
                                        Navbar text with an inline element
                                    &lt;/span&gt;
                                &lt;/div&gt;
                            &lt;/nav&gt;
                        </code>
                    </pre>
                    <p>Mix and match with other components and utilities as needed.</p>
                    <div class="bd-example">
                        <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
                            <a class="navbar-brand" href="#">Navbar</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarText">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Pricing</a>
                                    </li>
                                </ul>
                                <span class="navbar-text">
                                    Navbar text with an inline element
                                </span>
                            </div>
                        </nav>
                    </div>
                    <pre class="language-markup">
                        <code class="language-markup">
                            &lt;nav class=&quot;navbar navbar-expand-lg navbar-dark bg-warning&quot;&gt;
                                &lt;a class=&quot;navbar-brand&quot; href=&quot;#&quot;&gt;Navbar&lt;/a&gt;
                                &lt;button class=&quot;navbar-toggler&quot; type=&quot;button&quot; data-toggle=&quot;collapse&quot; data-target=&quot;#navbarText&quot; aria-controls=&quot;navbarText&quot; aria-expanded=&quot;false&quot; aria-label=&quot;Toggle navigation&quot;&gt;
                                    &lt;span class=&quot;navbar-toggler-icon&quot;&gt;&lt;/span&gt;
                                &lt;/button&gt;
                                &lt;div class=&quot;collapse navbar-collapse&quot; id=&quot;navbarText&quot;&gt;
                                    &lt;ul class=&quot;navbar-nav mr-auto&quot;&gt;
                                        &lt;li class=&quot;nav-item active&quot;&gt;
                                            &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Home &lt;span class=&quot;sr-only&quot;&gt;(current)&lt;/span&gt;&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Features&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Pricing&lt;/a&gt;
                                        &lt;/li&gt;
                                    &lt;/ul&gt;
                                    &lt;span class=&quot;navbar-text&quot;&gt;
                                        Navbar text with an inline element
                                    &lt;/span&gt;
                                &lt;/div&gt;
                            &lt;/nav&gt;
                        </code>
                    </pre>

                    <h4 class="subcontent-title" id="color"><span>Color schemes</span></h4>
                    <p>Theming the navbar has never been easier thanks to the combination of theming classes and <code class="highlighter-rouge">background-color</code> utilities. Choose from <code class="highlighter-rouge">.navbar-light</code> for use with light background colors, or <code class="highlighter-rouge">.navbar-dark</code> for dark background colors. Then, customize with <code class="highlighter-rouge">.bg-*</code> utilities.</p>
                    <div class="bd-example">
                        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
                            <a class="navbar-brand" href="#">Navbar</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarColor01">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">About</a>
                                    </li>
                                </ul>
                                <form class="form-inline">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>

                        <nav class="navbar navbar-expand-lg navbar-dark bg-default mb-3">
                            <a class="navbar-brand" href="#">Navbar</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarColor02">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">About</a>
                                    </li>
                                </ul>
                                <form class="form-inline">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>

                        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
                            <a class="navbar-brand" href="#">Navbar</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarColor02">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">About</a>
                                    </li>
                                </ul>
                                <form class="form-inline">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>

                        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary mb-3">
                            <a class="navbar-brand" href="#">Navbar</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarColor02">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">About</a>
                                    </li>
                                </ul>
                                <form class="form-inline">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>

                        <nav class="navbar navbar-expand-lg navbar-dark bg-info mb-3">
                            <a class="navbar-brand" href="#">Navbar</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarColor02">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">About</a>
                                    </li>
                                </ul>
                                <form class="form-inline">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>

                        <nav class="navbar navbar-expand-lg navbar-success bg-success mb-3">
                            <a class="navbar-brand" href="#">Navbar</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarColor02">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">About</a>
                                    </li>
                                </ul>
                                <form class="form-inline">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>

                        <nav class="navbar navbar-expand-lg navbar-dark bg-danger mb-3">
                            <a class="navbar-brand" href="#">Navbar</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarColor02">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">About</a>
                                    </li>
                                </ul>
                                <form class="form-inline">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>

                        <nav class="navbar navbar-expand-lg navbar-dark bg-warning mb-3">
                            <a class="navbar-brand" href="#">Navbar</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarColor02">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">About</a>
                                    </li>
                                </ul>
                                <form class="form-inline">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>

                        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
                            <a class="navbar-brand" href="#">Navbar</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarColor03">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">About</a>
                                    </li>
                                </ul>
                                <form class="form-inline">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>
                    </div>

                    <pre class="language-markup">
                        <code class="language-markup">
                            &lt;nav class=&quot;navbar navbar-expand-lg navbar-dark bg-dark&quot;&gt;
                            &lt;!-- Navbar content --&gt;
                            &lt;/nav&gt;

                            &lt;nav class=&quot;navbar navbar-expand-lg navbar-dark bg-default&quot;&gt;
                            &lt;!-- Navbar content --&gt;
                            &lt;/nav&gt;

                            &lt;nav class=&quot;navbar navbar-expand-lg navbar-dark bg-primary&quot;&gt;
                            &lt;!-- Navbar content --&gt;
                            &lt;/nav&gt;

                            &lt;nav class=&quot;navbar navbar-expand-lg navbar-dark bg-secondary&quot;&gt;
                            &lt;!-- Navbar content --&gt;
                            &lt;/nav&gt;

                            &lt;nav class=&quot;navbar navbar-expand-lg navbar-dark bg-info&quot;&gt;
                            &lt;!-- Navbar content --&gt;
                            &lt;/nav&gt;

                            &lt;nav class=&quot;navbar navbar-expand-lg navbar-dark bg-success&quot;&gt;
                            &lt;!-- Navbar content --&gt;
                            &lt;/nav&gt;

                            &lt;nav class=&quot;navbar navbar-expand-lg navbar-dark bg-danger&quot;&gt;
                            &lt;!-- Navbar content --&gt;
                            &lt;/nav&gt;

                            &lt;nav class=&quot;navbar navbar-expand-lg navbar-dark bg-warning&quot;&gt;
                            &lt;!-- Navbar content --&gt;
                            &lt;/nav&gt;

                            &lt;nav class=&quot;navbar navbar-expand-lg navbar-light bg-light&quot;&gt;
                            &lt;!-- Navbar content --&gt;
                            &lt;/nav&gt;
                        </code>
                    </pre>

                    <h4 class="subcontent-title" id="containers"><span>Containers</span></h4>
                    <p>When the container is within your navbar, its horizontal padding is removed at breakpoints lower than your specified <code class="highlighter-rouge">.navbar-expand{-sm|-md|-lg|-xl}</code> class. This ensures we’re not doubling up on padding unnecessarily on lower viewports when your navbar is collapsed.</p>
                    <div class="bd-example">
                        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
                            <div class="container">
                                <a class="navbar-brand" href="#">Navbar</a>
                            </div>
                        </nav>
                    </div>
                    <pre class="language-markup">
                        <code class="language-markup">
                            &lt;nav class=&quot;navbar navbar-expand-lg navbar-dark bg-danger&quot;&gt;
                                &lt;div class=&quot;container&quot;&gt;
                                    &lt;a class=&quot;navbar-brand&quot; href=&quot;#&quot;&gt;Navbar&lt;/a&gt;
                                &lt;/div&gt;
                            &lt;/nav&gt;
                        </code>
                    </pre>

                    <h4 class="subcontent-title" id="placement"><span>Placement</span></h4>
                    <p>Use our <a href="/docs/1.0/utilities/position/">position utilities</a> to place navbars in non-static positions. Choose from fixed to the top, fixed to the bottom, or stickied to the top (scrolls with the page until it reaches the top, then stays there). Fixed navbars use <code class="highlighter-rouge">position: fixed</code>, meaning they’re pulled from the normal flow of the DOM and may require custom CSS (e.g., <code class="highlighter-rouge">padding-top</code> on the <code class="highlighter-rouge">&lt;body&gt;</code>) to prevent overlap with other elements.</p>
                    <p>Also note that <strong><code class="highlighter-rouge">.sticky-top</code> uses <code class="highlighter-rouge">position: sticky</code>, which <a href="https://caniuse.com/#feat=css-sticky">isn’t fully supported in every browser</a></strong>.</p>
                    <div class="bd-example">
                        <nav class="navbar navbar-dark bg-info">
                            <a class="navbar-brand" href="#">Default</a>
                        </nav>
                    </div>
                    <pre class="language-markup">
                        <code class="language-markup">
                            &lt;nav class=&quot;navbar navbar-dark bg-info&quot;&gt;
                                &lt;a class=&quot;navbar-brand&quot; href=&quot;#&quot;&gt;Default&lt;/a&gt;
                            &lt;/nav&gt;
                        </code>
                    </pre>

                    <div class="bd-example">
                        <nav class="navbar fixed-top navbar-dark bg-warning">
                            <a class="navbar-brand" href="#">Fixed top</a>
                        </nav>
                    </div>
                    <pre class="language-markup">
                        <code class="language-markup">
                            &lt;nav class=&quot;navbar fixed-top navbar-dark bg-warning&quot;&gt;
                                &lt;a class=&quot;navbar-brand&quot; href=&quot;#&quot;&gt;Fixed top&lt;/a&gt;
                            &lt;/nav&gt;
                        </code>
                    </pre>

                    <div class="bd-example">
                        <nav class="navbar fixed-bottom navbar-dark bg-primary">
                            <a class="navbar-brand" href="#">Fixed bottom</a>
                        </nav>
                    </div>
                    <pre class="language-markup">
                        <code class="language-markup">
                            &lt;nav class=&quot;navbar fixed-bottom navbar-dark bg-primary&quot;&gt;
                                &lt;a class=&quot;navbar-brand&quot; href=&quot;#&quot;&gt;Fixed bottom&lt;/a&gt;
                            &lt;/nav&gt;
                        </code>
                    </pre>

                    <div class="bd-example">
                        <nav class="navbar sticky-top navbar-dark bg-default">
                            <a class="navbar-brand" href="#">Sticky top</a>
                        </nav>
                    </div>
                    <pre class="language-markup">
                        <code class="language-markup">
                            &lt;nav class=&quot;navbar sticky-top navbar-dark bg-default&quot;&gt;
                                &lt;a class=&quot;navbar-brand&quot; href=&quot;#&quot;&gt;Sticky top&lt;/a&gt;
                            &lt;/nav&gt;
                        </code>
                    </pre>

                    <h4 class="subcontent-title" id="responsive"><span>Responsive behaviors</span></h4>
                    <p>Navbars can utilize <code class="highlighter-rouge">.navbar-toggler</code>, <code class="highlighter-rouge">.navbar-collapse</code>, and <code class="highlighter-rouge">.navbar-expand{-sm|-md|-lg|-xl}</code> classes to change when their content collapses behind a button. In combination with other utilities, you can easily choose when to show or hide particular elements.</p>
                    <p>For navbars that never collapse, add the <code class="highlighter-rouge">.navbar-expand</code> class on the navbar. For navbars that always collapse, don’t add any <code class="highlighter-rouge">.navbar-expand</code> class.</p>
                    <h5 id="toggler">Toggler</h5>
                    <p>Navbar togglers are left-aligned by default, but should they follow a sibling element like a <code class="highlighter-rouge">.navbar-brand</code>, they’ll automatically be aligned to the far right. Reversing your markup will reverse the placement of the toggler. Below are examples of different toggle styles.</p>
                    <p>With no <code class="highlighter-rouge">.navbar-brand</code> shown in lowest breakpoint:</p>
                    <div class="bd-example">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                                <a class="navbar-brand" href="#">Hidden brand</a>
                                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Link</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#">Disabled</a>
                                    </li>
                                </ul>
                                <form class="form-inline my-2 my-lg-0">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>
                    </div>
                    <pre class="language-markup">
                        <code class="language-markup">
                            &lt;nav class=&quot;navbar navbar-expand-lg navbar-light bg-light&quot;&gt;
                                &lt;button class=&quot;navbar-toggler&quot; type=&quot;button&quot; data-toggle=&quot;collapse&quot; data-target=&quot;#navbarTogglerDemo01&quot; aria-controls=&quot;navbarTogglerDemo01&quot; aria-expanded=&quot;false&quot; aria-label=&quot;Toggle navigation&quot;&gt;
                                    &lt;span class=&quot;navbar-toggler-icon&quot;&gt;&lt;/span&gt;
                                &lt;/button&gt;
                                &lt;div class=&quot;collapse navbar-collapse&quot; id=&quot;navbarTogglerDemo01&quot;&gt;
                                    &lt;a class=&quot;navbar-brand&quot; href=&quot;#&quot;&gt;Hidden brand&lt;/a&gt;
                                    &lt;ul class=&quot;navbar-nav mr-auto mt-2 mt-lg-0&quot;&gt;
                                        &lt;li class=&quot;nav-item active&quot;&gt;
                                            &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Home &lt;span class=&quot;sr-only&quot;&gt;(current)&lt;/span&gt;&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot;&gt;Disabled&lt;/a&gt;
                                        &lt;/li&gt;
                                    &lt;/ul&gt;
                                    &lt;form class=&quot;form-inline my-2 my-lg-0&quot;&gt;
                                        &lt;input class=&quot;form-control mr-sm-2&quot; type=&quot;search&quot; placeholder=&quot;Search&quot; aria-label=&quot;Search&quot;&gt;
                                        &lt;button class=&quot;btn btn-outline-success my-2 my-sm-0&quot; type=&quot;submit&quot;&gt;Search&lt;/button&gt;
                                    &lt;/form&gt;
                                &lt;/div&gt;
                            &lt;/nav&gt;
                        </code>
                    </pre>
                    <p>With a brand name shown on the left and toggler on the right:</p>
                    <div class="bd-example">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <a class="navbar-brand" href="#">Navbar</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Link</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#">Disabled</a>
                                    </li>
                                </ul>
                                <form class="form-inline my-2 my-lg-0">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>
                    </div>
                    <pre class="language-markup">
                        <code class="language-markup">
                            &lt;nav class=&quot;navbar navbar-expand-lg navbar-light bg-light&quot;&gt;
                                &lt;a class=&quot;navbar-brand&quot; href=&quot;#&quot;&gt;Navbar&lt;/a&gt;
                                &lt;button class=&quot;navbar-toggler&quot; type=&quot;button&quot; data-toggle=&quot;collapse&quot; data-target=&quot;#navbarTogglerDemo02&quot; aria-controls=&quot;navbarTogglerDemo02&quot; aria-expanded=&quot;false&quot; aria-label=&quot;Toggle navigation&quot;&gt;
                                    &lt;span class=&quot;navbar-toggler-icon&quot;&gt;&lt;/span&gt;
                                &lt;/button&gt;

                                &lt;div class=&quot;collapse navbar-collapse&quot; id=&quot;navbarTogglerDemo02&quot;&gt;
                                    &lt;ul class=&quot;navbar-nav mr-auto mt-2 mt-lg-0&quot;&gt;
                                        &lt;li class=&quot;nav-item active&quot;&gt;
                                            &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Home &lt;span class=&quot;sr-only&quot;&gt;(current)&lt;/span&gt;&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot;&gt;Disabled&lt;/a&gt;
                                        &lt;/li&gt;
                                    &lt;/ul&gt;
                                    &lt;form class=&quot;form-inline my-2 my-lg-0&quot;&gt;
                                        &lt;input class=&quot;form-control mr-sm-2&quot; type=&quot;search&quot; placeholder=&quot;Search&quot;&gt;
                                        &lt;button class=&quot;btn btn-outline-success my-2 my-sm-0&quot; type=&quot;submit&quot;&gt;Search&lt;/button&gt;
                                    &lt;/form&gt;
                                &lt;/div&gt;
                            &lt;/nav&gt;
                        </code>
                    </pre>
                    <p>With a toggler on the left and brand name on the right:</p>
                    <div class="bd-example">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <a class="navbar-brand" href="#">Navbar</a>

                            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Link</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#">Disabled</a>
                                    </li>
                                </ul>
                                <form class="form-inline my-2 my-lg-0">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>
                    </div>
                    <pre class="language-markup">
                        <code class="language-markup">
                            &lt;nav class=&quot;navbar navbar-expand-lg navbar-light bg-light&quot;&gt;
                                &lt;button class=&quot;navbar-toggler&quot; type=&quot;button&quot; data-toggle=&quot;collapse&quot; data-target=&quot;#navbarTogglerDemo03&quot; aria-controls=&quot;navbarTogglerDemo03&quot; aria-expanded=&quot;false&quot; aria-label=&quot;Toggle navigation&quot;&gt;
                                    &lt;span class=&quot;navbar-toggler-icon&quot;&gt;&lt;/span&gt;
                                &lt;/button&gt;
                                &lt;a class=&quot;navbar-brand&quot; href=&quot;#&quot;&gt;Navbar&lt;/a&gt;

                                &lt;div class=&quot;collapse navbar-collapse&quot; id=&quot;navbarTogglerDemo03&quot;&gt;
                                    &lt;ul class=&quot;navbar-nav mr-auto mt-2 mt-lg-0&quot;&gt;
                                        &lt;li class=&quot;nav-item active&quot;&gt;
                                            &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Home &lt;span class=&quot;sr-only&quot;&gt;(current)&lt;/span&gt;&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot;&gt;Disabled&lt;/a&gt;
                                        &lt;/li&gt;
                                    &lt;/ul&gt;
                                    &lt;form class=&quot;form-inline my-2 my-lg-0&quot;&gt;
                                        &lt;input class=&quot;form-control mr-sm-2&quot; type=&quot;search&quot; placeholder=&quot;Search&quot; aria-label=&quot;Search&quot;&gt;
                                        &lt;button class=&quot;btn btn-outline-success my-2 my-sm-0&quot; type=&quot;submit&quot;&gt;Search&lt;/button&gt;
                                    &lt;/form&gt;
                                &lt;/div&gt;
                            &lt;/nav&gt;
                        </code>
                    </pre>
                </div> -->
            </div>
        </div>
    </div>

</div>
@endsection
