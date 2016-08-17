<?php
$key = "Getting Started ng2";
$pageTitle = "Best Angular 2 Data Grid";
$pageDescription = "Demonstrate the best Angular 2 data grid. Shows and example of a data grid for using with Angular 2.";
$pageKeyboards = "Angular 2 Grid";
include '../documentation-main/documentation_header.php';
?>

<div>

    <h2>Best Angular 2 Data Grid</h2>

    <p>
        When using Angular 2, you must use the CommonJS distribution of Angular 2 and ag-Grid. That means the
        already bundled ag-Grid and Angular 2 UMD will not work (if you don't know what this means or what these
        are, then don't worry, you will be none the wiser).
    </p>

    <p>If you MUST use the UMD version of Angular 2, then use the plain Javascript version of ag-Grid.</p>

    <h3>Angular 2 Still in Release Candidate</h3>

    <p>
        ag-Grid's integration is been developed against beta versions of Angular 2.
        Until the final version is released, ag-Grid's integration with Angular 2
        is also liable to change. The examples below work with Angular version 2.0.0-rc.1 - at the time of writing, that is the latest version.
    </p>

    <h3>Angular 2 Full Example</h3>

    <p>
        This page goes through <a href="https://github.com/helix46/ag-grid-angular2-beta-ts"> the
        <a href="https://github.com/ceolter/ag-grid-ng2-example">Angular 2, SystemX, JSPM, Typescript</a>
        example on Github. Because the example depends on SystemX and JSPM, it is not included in the
        online documentation.
    </p>

    <h3>Dependencies</h3>

    <p>
        In your package.json file, specify dependency on ag-grid AND ag-grid-ng2.
        The ag-grid package contains the core ag-grid engine and the ag-grid-ng2
        contains the Angular 2 component.
        <pre><code>"dependencies": {
    ...
    "ag-grid": "5.0.x",
    "ag-grid-ng2": "5.0.x"
}</code></pre>
    The major and minor versions should match. Every time a new major or minor
    version of ag-Grid is released, the component will also be released. However
    for patch versions, the component will not be released.
    </p>

    <p>You will then bbe able to access ag-Grid inside your application:</p>

    <pre>import {AgGridNg2} from 'ag-grid-ng2/main';</pre>

    <p>
        Which you can then use as a directive inside component:
    </p>

    <pre>@Component({
    directives: [AgGridNg2],
    ...
})</pre>

    <p>
        You will need to include the CSS for ag-Grid, either directly inside
        your html page, or as part of creating your bundle if bundling. Teh following
        shows referencing the css from your web page:
    </p>
    <pre>&lt;link href="node_modules/ag-grid/styles/ag-grid.css" rel="stylesheet" />
&lt;link href="node_modules/ag-grid/styles/theme-fresh.css" rel="stylesheet" />
</pre>

    <p>
        You will also need to configure SystemX for ag-grid and ag-grid-component as follows:
    </p>

    <pre>System.config({
    packages: {
        lib: {
            format: 'register',
            defaultExtension: 'js'
        },
        'ag-grid-ng2': {
            defaultExtension: "js"
        },
        'ag-grid': {
            defaultExtension: "js"
        }
    },
    map: {
        'ag-grid-ng2': 'node_modules/ag-grid-ng2',
        'ag-grid': 'node_modules/ag-grid'
    }
});</pre>

    <p>
        All the above items are specific to either Angular 2 or SystemX. The above is intended to point
        you in the right direction. If you need more information on this, please see the documentation
        for those projects.
    </p>

    <h2>Configuring ag-Grid in Angular 2</h2>

    <p>You can configure the grid in the following ways through Angular 2:</p>
    <ul>
        <li><b>Events:</b> All data out of the grid comes through events. These use
            Angular 2 event bindings eg <i>(modelUpdated)="onModelUpdated()"</i>.
            As you interact with the grid, the different events are fixed and
            output text to the console (open the dev tools to see the console).
        </li>
        <li><b>Properties:</b> All the data is provided to the grid as Angular 2
            bindings. These are bound onto the ag-Grid properties bypassing the
            elements attributes. The values for the bindings come from the parent
            controller.
        </li>
        <li><b>Attributes:</b> When the property is just a simple string value, then
            no binding is necessary, just the value is placed as an attribute
            eg <i>rowHeight="22"</i>. Notice that boolean attributes are defaulted
            to 'true' IF they attribute is provided WITHOUT any value. If the attribute
            is not provided, it is taken as false.
        </li>
        <li><b>Grid API via IDs:</b> The grid in the example is created with an id
            by marking it with <i>#agGrid</i>. This in turn turns into a variable
            which can be used to access the grid's controller. The buttons
            Grid API and Column API buttons use this variable to access the grids
            API (the API's are attributes on the controller).
        </li>
        <li><b>Changing Properties:</b> When a property changes value, AngularJS
            automatically passes the new value onto the grid. This is used in
            the following locations:<br/>
            a) The 'quickFilter' on the top right updates the quick filter of
            the grid.
            b) The 'Show Tool Panel' checkbox has it's value bound to the 'showToolPanel'
            property of the grid.
            c) The 'Refresh Data' generates new data for the grid and updates the
            <i>rowData</i> property.
        </li>
    </ul>

    <p>
        Notice that the grid has it's properties marked as <b>immutable</b>. Hence for
        object properties, the object reference must change for the grid to take impact.
        For example, <i>rowData</i> must be a new list of data for the grid to be
        informed to redraw.
    </p>

    <p>
        The example has ag-Grid configured through the template in the following ways:
    </p>

    <pre>// notice the grid has an id called agGrid, which can be used to call the API
&lt;ag-grid-ng2 #agGrid style="width: 100%; height: 350px;" class="ag-fresh"

    // items bound to properties on the controller
    [gridOptions]="gridOptions"
    [columnDefs]="columnDefs"
    [showToolPanel]="showToolPanel"
    [rowData]="rowData"

    // boolean values 'turned on'
    enableColResize
    enableSorting
    enableFilter

    // simple values, not bound
    rowHeight="22"
    rowSelection="multiple"

    // event callbacks
    (modelUpdated)="onModelUpdated()"
    (cellClicked)="onCellClicked($event)"
    (cellDoubleClicked)="onCellDoubleClicked($event)">
&lt;/ag-grid-ng2></pre>

    <h2>Dynamic Components</h2>

    <p>Two way binding in ag-Grid is via Components when using Angular 2</p>

    <note>
        <p>
            We here at ag-Grid owe a debt of thanks to Neal Borelli @ Thermo Fisher Scientific who provided a fully working implementation for us to use as a basis for our Angular 2 "dynamic cell" offering.
        <p>
        </p>
            Neal's assistance was a big help in being able to get something out faster than we would have otherwise - thanks Neal!
        </p>
    </note>


    <h3>AgGridCellRendererFactory</h3>

    <p>We offer two methods to add components to ag-Grid, and both are exposed by the use of AgGridCellRendererFactory</p>

    <pre>import {AgGridCellRendererFactory} from 'ag-grid-ng2/main';</pre>

    <h4>Adding components via Template Strings</h4>

    You can add a cellRenderer component supplying a string as a template - the <code>params</code> argument passed to cellRenders is available in the template:

    <pre ng-non-bindable>
        {
            headerName: "Square Template",
            field: "index",
            cellRenderer: this.agGridCellRendererFactory.createCellRendererFromTemplate('{{params.value * params.value}}')
            width: 200
        },
    </pre>

    <h4>Adding components via Components</h4>

    <p>You can add a cellRenderer component supplying a regular Angular 2 Component.</p>

    <p>If your component implements the <code>AgGridAware</code> (or just implements <code>setGridParameters(params)</code>), then the <code>params</code> argument
        passed to cellRenders will be set via this method

    <pre ng-non-bindable>
        @Component({
            selector: 'square-cell',
            template: `{{valueSquared()}}`
        })
        class SquareComponent implements AgGridAware {
            private params:any;

            setGridParameters(params:any):void {
                this.params = params;
            }

            private valueSquared():number {
                return this.params.value * this.params.value;
            }
        }
    </pre>
    <pre>
        {
            headerName: "Square Component",
            field: "index",
            cellRenderer: this.agGridCellRendererFactory.createCellRendererFromComponent(SquareComponent),
            width: 200
        },
    </pre>

    <h2>Destroy</h2>

    <p>
        The grid ties in with the Angular 2 lifecycle and releases all resources when the directive is destroyed. The example above demonstrates this
        by taking the element out of the DOM via *ngIf (which, unlike *ng-show, destroys the directives).
    </p>
    <p>
        If you have any resources you wish to release in a given component then you need to implement <code>OnDestroy</code>
        <pre ng-non-bindable>
        ngOnDestroy() {
            console.log(`Destroying SquareComponent`);
        }
        </pre>
    </p>

    <h2>Known Issues</h2>

    <p>
        <b>"Attempt to use a dehydrated detector"</b>
    </p>

    <p>
        If you are getting the above error, then check out <a href="https://www.ag-grid.com/forum/showthread.php?tid=3537">this post</a>
        where jose_DS shines some light on the issue.
    </p>

    <h2>Next Steps...</h2>

    <p>
        Now you can go to <a href="../javascript-grid-interfacing-overview/index.php">interfacing</a>
        to learn about accessing all the features of the grid.
    </p>

</div>

<?php include '../documentation-main/documentation_footer.php';?>
