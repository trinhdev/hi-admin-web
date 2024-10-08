<?php

namespace App\Contract\Hi_FPT;

use Illuminate\Support\Arr;

abstract class SettingInterface
{
    /**
     * The settings data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Whether the store has changed since it was last loaded.
     *
     * @var boolean
     */
    protected $unsaved = false;

    /**
     * Whether the settings data are loaded.
     *
     * @var boolean
     */
    protected $loaded = false;

    /**
     * Get a specific key from the settings data.
     *
     * @param string|array $key
     * @param mixed $default Optional default value.
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $this->load();

        return Arr::get($this->data, $key, $default);
    }

    public function getCronJob() {
        $this->loadCron();
        return Arr::get($this->data, null, null);
    }

    /**
     * Determine if a key exists in the settings data.
     *
     * @param string $key
     *
     * @return boolean
     */
    public function has(string $key): bool
    {
        $this->load();

        return Arr::has($this->data, $key);
    }

    /**
     * Set a specific key to a value in the settings data.
     *
     * @param string|array $key Key string or associative array of key => value
     * @param mixed $value Optional only if the first argument is an array
     * @return $this
     */
    public function set($key, $value = null): self
    {
        $this->load();
        $this->unsaved = true;

        if (is_array($key)) {
            foreach ($key as $k => $v) {
                Arr::set($this->data, $k, $v);
            }
        } else {
            Arr::set($this->data, $key, $value);
        }

        return $this;
    }

    /**
     * Unset a key in the settings data.
     *
     * @param string $key
     * @return $this
     */
    public function forget(string $key): self
    {
        $this->unsaved = true;

        if ($this->has($key)) {
            Arr::forget($this->data, $key);
        }

        return $this;
    }

    /**
     * Unset all keys in the settings data.
     *
     * @return $this
     */
    public function forgetAll(): self
    {
        $this->unsaved = true;
        $this->data = [];

        return $this;
    }

    /**
     * Get all settings data.
     *
     * @return array
     */
    public function all(): array
    {
        $this->load();

        return $this->data;
    }

    /**
     * Save any changes done to the settings data.
     *
     * @return false
     */
    public function save(): bool
    {
        if (!$this->unsaved) {
            // either nothing has been changed, or data has not been loaded, so
            // do nothing by returning early
            return false;
        }

        $this->write($this->data);
        $this->unsaved = false;

        return true;
    }

    /**
     * Make sure data is loaded.
     *
     * @param boolean $force Force a reload of data. Default false.
     */
    public function load(bool $force = false)
    {
        if (!$this->loaded || $force) {
            $this->data = $this->read();
            $this->loaded = true;
        }
    }

    public function loadCron(bool $force = false)
    {
        if (!$this->loaded || $force) {
            $this->data = $this->loadCronJob();
            $this->loaded = true;
        }
    }

    /**
     * Read the data from the store.
     *
     * @return array
     */
    abstract protected function read(): array;
    abstract protected function loadCronJob(): array;


    /**
     * Write the data into the store.
     *
     * @param array $data
     *
     * @return void
     */
    abstract protected function write(array $data);
}
