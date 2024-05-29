[{include file="ga4/admin/d3ga4uiheaditem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]
<style>
    body {
        background-image: linear-gradient(to top, #d5d4d0 0%, #d5d4d0 1%, #eeeeec 31%, #efeeec 75%, #e9e9e7 100%);
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
    [{else}]
    [{assign var="readonly" value=""}]
    [{/if}]

<div>
    <form name="d3gtmformedit" id="d3gtmformedit" action="[{$oViewConf->getSelfLink()}]" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col-6">
                [{$oViewConf->getHiddenSid()}]
                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                <input type="hidden" name="fnc" value="">
                <input type="hidden" name="editlanguage" value="[{$editlanguage}]">

                <div class="card mb-5">
                    <div class="card-header">
                        [{oxmultilang ident="D3BASECONFIG"}]
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" name="editval[bool][_blEnableGa4]" [{if $d3ViewObject->d3GetModuleConfigParam('_blEnableGa4')}]checked[{/if}] id="blGA4enab">
                            <label class="form-check-label" for="flexCheckDefault">
                                [{oxmultilang ident="D3ACTIVATEMOD"}] [{if false === $d3ViewObject->d3GetModuleConfigParam('_blEnableGa4')}]<span style="color: red">[{oxmultilang ident="D3INACTIVATEMOD"}]</span>[{/if}]
                            </label>
                        </div>
                        <div class="input-group mb-3 w-50">
                            <span class="input-group-text" id="basic-addon3">[{oxmultilang ident="D3CONTAINERID"}]</span>
                            <input type="text" class="form-control" id="_sContainerID" name="editval[str][_sContainerID]" aria-describedby="basic-addon3" value="[{$d3ViewObject->d3GetModuleConfigParam('_sContainerID')}]">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="_blEnableDebug" name="editval[bool][_blEnableDebug]" [{if $d3ViewObject->d3GetModuleConfigParam('_blEnableDebug')}]checked[{/if}]>
                            <label class="form-check-label" for="flexCheckDefault">
                                [{oxmultilang ident="D3USEDEBUGMODE"}][{oxinputhelp ident="D3USEDEBUGMODE_HELP"}]
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="_blActivateConsentMode" name="editval[bool][_blEnableConsentMode]" [{if $d3ViewObject->d3GetModuleConfigParam('_blEnableConsentMode')}]checked[{/if}]>
                            <label class="form-check-label" for="flexCheckChecked">
                                [{oxmultilang ident="D3USEGOOGLECONSENTMODE"}][{oxinputhelp ident="D3USEGOOGLECONSENTMODE_HELP"}]
                            </label>
                        </div>
                    </div>
                    <button type="submit" name="save" class="btn btn-light" onClick="Javascript:document.d3gtmformedit.fnc.value='save'">[{oxmultilang ident="GENERAL_SAVE"}]</button>
                </div>
            </div>
            <div class="col-6">
                <div class="card border border-0">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-cmpsettings" aria-expanded="true" aria-controls="panelsStayOpen-cmpsettings">
                                    [{oxmultilang ident="D3CMPTABTITLE"}]
                                </button>
                            </h2>
                            <div id="panelsStayOpen-cmpsettings" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="editval[bool][_blEnableOwnCookieManager]" value="" id="_hasOwnCookieManager" [{if $d3ViewObject->d3GetModuleConfigParam('_blEnableOwnCookieManager')}]checked[{/if}]>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            [{oxmultilang ident="D3CMPUSEQ"}][{oxinputhelp ident="D3CMPUSEQ_HELP"}]
                                        </label>
                                    </div>
                                    <div class="input-group mb-3 w-75">
                                        <span class="input-group-text" id="basic-addon3">[{oxmultilang ident="D3CNTRLPARAM"}]</span>
                                        <input type="text" class="form-control" id="_controlParameter" name="editval[str][_sControlParameter]" value="[{$d3ViewObject->d3GetModuleConfigParam('_sControlParameter')}]" aria-describedby="basic-addon3">
                                    </div>
                                    <label>
                                        [{oxmultilang ident="D3CMP"}]
                                    </label>
                                    <select class="form-select w-50" name="editval[select][_HAS_STD_MANAGER]" aria-label="Default select example">
                                        <option value="NONE" selected>[{oxmultilang ident="D3NONE"}]</option>
                                        [{foreach from=$d3ManagerTypeArray key="sManagerName" item="sCmpName" name="editval[aCmpNameArray]"}]
                                        <option value="[{$sCmpName}]" [{if $sCmpName === $d3ViewObject->d3GetModuleConfigParam('_HAS_STD_MANAGER')}]SELECTED[{/if}]>[{$sManagerName}]</option>
                                        [{/foreach}]
                                    </select>
                                </div>
                                <button type="submit" name="save" class="btn btn-light w-100" onClick="Javascript:document.d3gtmformedit.fnc.value='save'">[{oxmultilang ident="GENERAL_SAVE"}]</button>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-serversidetagging" aria-expanded="false" aria-controls="panelsStayOpen-serversidetagging">
                                    [{oxmultilang ident="D3SERVERSIDETAGGING"}]
                                </button>
                            </h2>
                            <div id="panelsStayOpen-serversidetagging" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="card bg-light rounded mb-3">
                                        <div class="card-body">
                                            [{oxmultilang ident="D3SERVERSIDETAGGING_HINT"}]
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text w-25" id="basic-addon3">[{oxmultilang ident="D3SERVERSIDETAGGING_TITLE_ACTIVE"}]</span>
                                        <input type="text" class="form-control" id="_serversidetagging_js" name="editval[str][_sServersidetagging_js]" value="[{$d3ViewObject->d3GetModuleConfigParam('_sServersidetagging_js')}]" aria-describedby="basic-addon3">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text w-25" id="basic-addon3">[{oxmultilang ident="D3SERVERSIDETAGGING_TITLE_PASSIVE"}]</span>
                                        <input type="text" class="form-control" id="_serversidetagging_nojs" name="editval[str][_sServersidetagging_nojs]" value="[{$d3ViewObject->d3GetModuleConfigParam('_sServersidetagging_nojs')}]" aria-describedby="basic-addon3">
                                    </div>

                                    <div>
                                        <button type="button" class="btn btn-light mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            [{oxmultilang ident="D3DETAILED_DESC"}]
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <h4>[{oxmultilang ident="D3SERVERSIDETAGGING_TITLE_ACTIVE"}]</h4>
                                                        [{oxmultilang ident="D3SERVERSIDETAGGING_ACTIVE"}]
                                                        <hr>
                                                        <h4>[{oxmultilang ident="D3SERVERSIDETAGGING_TITLE_PASSIVE"}]</h4>
                                                        [{oxmultilang ident="D3SERVERSIDETAGGING_PASSIVE"}]
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">[{oxmultilang ident="D3CLOSE"}]</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="save" class="btn btn-light w-100" onClick="Javascript:document.d3gtmformedit.fnc.value='save'">[{oxmultilang ident="GENERAL_SAVE"}]</button>
                            </div>
                        </div>
                        [{if $d3ViewConfObject->d3IsUsercentricsCMPChosen()}]
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-usercentricsdynamicoptions" aria-expanded="false" aria-controls="panelsStayOpen-usercentricsdynamicoptions">
                                    [{oxmultilang ident="D3USRCNTRCSDYNOPT"}]
                                </button>
                            </h2>
                            <div id="panelsStayOpen-usercentricsdynamicoptions" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="card bg-light rounded mb-3">
                                        <div class="card-body">
                                            <div class="text-danger mb-3">
                                                [{oxmultilang ident="D3USRCNTRCSCFG_WARNING"}]
                                            </div>
                                            [{oxmultilang ident="D3USRCNTRCSCFG_DOCS"}]
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="enabledefaultmeasurementvalues" name="editval[bool][_blEnableMeasurementCapabilities]" [{if $d3ViewObject->d3GetModuleConfigParam('_blEnableMeasurementCapabilities')}]checked[{/if}]>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            [{oxmultilang ident="D3USRCNTRCSCFG_ACT_INDIVDEFVAL"}]
                                        </label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text w-25" id="basic-addon3">[{oxmultilang ident="D3USRCNTRCSCFG_STD_CNST"}]</span>
                                        <textarea name="editval[str][_sMeasurementCapabilities]" class="form-control" rows="15">[{$d3ViewObject->d3GetModuleConfigParam('_sDefaultMeasurementCapabilities')}]</textarea>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="enableUsercentricsConsentModeApi" name="editval[bool][_blEnableUsercentricsConsentModeApi]" [{if $d3ViewObject->d3GetModuleConfigParam('_blEnableUsercentricsConsentModeApi')}]checked[{/if}]>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            [{oxmultilang ident="D3USRCNTRCSCFG_ACT_CNSTMDE_API"}]
                                        </label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text w-25" id="basic-addon3">[{oxmultilang ident="D3USRCNTRCSCFG_CNSTMDE_API"}]</span>
                                        <textarea name="editval[str][_sUsercentricsConsentModeApi]" class="form-control" rows="40">[{$d3ViewObject->d3GetModuleConfigParam('_sDefaultUsercentricsConsentModeApi')}]</textarea>
                                    </div>
                                </div>
                                <button type="submit" name="save" class="btn btn-light w-100" onClick="Javascript:document.d3gtmformedit.fnc.value='save'">[{oxmultilang ident="GENERAL_SAVE"}]</button>
                            </div>
                        </div>
                        [{/if}]
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>