<?php $view->script('highlight-settings', 'highlight:app/bundle/settings.js', ['vue']) ?>

<div id="highlight-settings" class="uk-form-horizontal" v-cloak>
    <div class="pk-grid-large" uk-grid>
        <div class="pk-width-sidebar">
            <div class="uk-panel">
                <ul class="uk-nav uk-nav-default pk-nav-large" uk-switcher="connect: #tab-content">
                    <li><a><i class="pk-icon-large-settings uk-margin-right"></i> {{ 'Highlight Settings' | trans }}</a></li>
                </ul>
            </div>
        </div>

        <div class="pk-width-content">
            <div class="uk-margin">
                <label class="uk-form-label" for="input-style">{{ 'Style' | trans }}</label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="input-style" v-model="highlight.config.style" v-if="stylelists.length">
                        <option v-for="option in stylelists" :value="option">
                            {{ option }}
                        </option>
                    </select>
                    <div v-else>
                        {{ 'Loading styles...' | trans }}
                    </div>
                </div>
            </div>

            <div class="uk-margin">
                <label class=" uk-form-label">{{ 'Pages' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <input class="uk-input" :active.sync="highlight.config.nodes"> </input>
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="input-enable-auto">{{ 'Auto Detect' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <input type="checkbox" id="input-enable-auto" name="input-enable-auto" class="uk-radio" value="auto" v-model="highlight.config.autodetect">
                    <label for="input-enable-auto">
                        {{ 'Only load when code found on page' | trans }}
                    </label>
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-form-controls">
                    <button class="uk-button uk-button-primary uk-button-small" @click="save">{{ 'Save' | trans }}</button>
                </div>
            </div>
        </div>

    </div>
</div>