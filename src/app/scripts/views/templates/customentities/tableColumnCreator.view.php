<ui:form method="POST">
    <div class="ce-primary-key-1">
        <div class="gray-box">
            <label class="w90">Name:</label>
            <ui:textbox name="column-name" />
        </div>
        <div class="gray-box">
            <label class="block">Description:</label>
            <ui:textarea name="column-description" class="w700 h60" />
        </div>
        <div class="gray-box">
            <label class="w90">Type:</label>
            <ui:dropdownlist name="column-type" source="ced:tableColumnTypes" display="name" value="key" data-toggler="type" />
        </div>
        <div class="gray-box">
            <label class="w90">Options:</label>
            <label>
                <ui:checkbox name="column-required" />
                Required
            </label>
            <label>
                <ui:checkbox name="column-unique" />
                Unique
            </label>
        </div>
        <div data-toggle="type-int">
            <div class="gray-box">
                <strong>Integer</strong>
            </div>
            <div class="gray-box">
                <label class="w90">Size:</label>
                <ui:textbox name="column-int-size" default="11" />
            </div>
        </div>
        <div data-toggle="type-float">
            <div class="gray-box">
                <strong>Float</strong>
            </div>
            <div class="gray-box">
                <label class="w90">Size:</label>
                <ui:textbox name="column-float-size" default="10" />
            </div>
            <div class="gray-box">
                <label class="w90">Decimals:</label>
                <ui:textbox name="column-float-decimals" default="2" />
            </div>
        </div>
        <div data-toggle="type-double">
            <div class="gray-box">
                <strong>Double</strong>
            </div>
            <div class="gray-box">
                <label class="w90">Size:</label>
                <ui:textbox name="column-float-size" default="16" />
            </div>
            <div class="gray-box">
                <label class="w90">Decimals:</label>
                <ui:textbox name="column-float-decimals" default="2" />
            </div>
        </div>
        <div data-toggle="type-varchar">
            <div class="gray-box">
                <strong>Text (varchar)</strong>
            </div>
            <div class="gray-box">
                <label class="w90">Size:</label>
                <ui:textbox name="column-varchar-size" default="50" />
            </div>
        </div>
        <div data-toggle="type-url">
            <div class="gray-box">
                <strong>URL</strong>
            </div>
            <div class="gray-box">
                <label class="w90">Size:</label>
                <ui:textbox name="column-url-size" default="50" />
            </div>
        </div>
        <div data-toggle="type-singlereference">
            <div class="gray-box">
                <strong>Single Reference</strong>
            </div>
            <div class="gray-box">
                <label class="w90">Table:</label>
                <ui:textbox name="column-singlerefence-table" />
            </div>
            <div class="gray-box">
                <label class="w90">Column:</label>
                <ui:textbox name="column-singlerefence-column" />
            </div>
        </div>
        <div data-toggle="type-multireference-jointable">
            <div class="gray-box">
                <strong>Multi Reference</strong>
            </div>
            <div class="gray-box">
                <label class="w120">Join Table:</label>
                <ui:textbox name="column-multireference-table" class="w200" />
            </div>
            <div class="gray-box">
                <label class="w120">Primary Key 1:</label>
                <ui:textbox name="column-multireference-primarykey1-column" />
            </div>
            <div class="gray-box">
                <label class="w120">Primary Key 2:</label>
                <ui:textbox name="column-multireference-primarykey2-column" />
            </div>
            <div class="gray-box">
                <label class="w120">Primary Key 3:</label>
                <ui:textbox name="column-multireference-primarykey3-column" />
            </div>
            <div class="gray-box">
                <label class="w120" title="Column where selected foreign ids will be stored">Target Column:</label>
                <ui:textbox name="column-multireference-targetcolumn" />
            </div>
        </div>
    </div>
    <div class="gray-box">
        <input type="hidden" name="save" value="create" />
        <button type="submit" name="save" value="create">Create</button>
    </div>
</ui:form>