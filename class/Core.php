<?php

class Core
{
	private
		$appPath,
		$dbFile,
		$reConfig,
		$reDatabase,
		$db,
		$input,
		$error = [];

	public function init($config)
	{
		$this->appPath = $config['application'];
		$this->dbFile = $config['db_file'];
		$this->reConfig = [$config['base_url']];
		$this->reDatabase = [$config['hostname'], $config['username'], $config['password'], $config['database']];

		if (!is_dir($this->appPath)) $this->error[] = "Folder application salah";
		if (!file_exists($this->dbFile)) $this->error[] = "File sql tidak ditemukan";

		return $this->error;
	}

	public function setInput($input)
	{
		$this->input = (object) $input;
	}

	public function reWrite()
	{
		$reWriteFile = ['config', 'database'];

		foreach ($reWriteFile as $fileName) :
			$filePath = "$this->appPath/config/$fileName.php";
			
			if (is_writeable($filePath)) :
				$find = ($fileName == 'config') ? $this->reConfig : $this->reDatabase;
				$replace = ($fileName == 'config') ? [$this->input->base_url] : [$this->input->hostname, $this->input->username, $this->input->password, $this->input->database];
				$file = file_get_contents($filePath);
				$file = str_replace($find, $replace, $file);
				$reWrite = file_put_contents($filePath, $file);
			else :
				$this->error[] = "File $fileName.php tidak dapat dirubah";
			endif;
		endforeach;

		return $this->error ? FALSE : TRUE;
	}

	public function checkDB()
	{
		$db = @new mysqli($this->input->hostname, $this->input->username, $this->input->password, $this->input->database);
		
		if ($db->connect_errno) $this->error[] = $db->connect_error;

		@$db->close();

		return $this->error ? FALSE : TRUE;
	}

	public function createTables()
	{
		$queries = file_get_contents($this->dbFile);
		$db = new mysqli($this->input->hostname, $this->input->username, $this->input->password, $this->input->database);
		$db->multi_query($queries);
		$db->close();
	}

	public function getError()
	{
		return $this->error;
	}
}
