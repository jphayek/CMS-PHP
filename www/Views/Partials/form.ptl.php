<style>

.form-button, .form-button-res {
    padding: 12px 25px;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    border: none;
    border-radius: 12px;
  }

  .form-button {
    background-color: #4CAF50;
    color: white;
  }

  .form-button:hover {
    background-color: #45a049;
  }

  .form-button-res {
    background-color: #cc3434;
    color: white;
  }

  .form-button-res:hover {
    background-color: #b02e2e;
  }

.form-group {
    margin-bottom: 20px;
  }

  .form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

</style>
<form method="<?= $config["config"]["method"] ?>"
      action="<?= $config["config"]["action"] ?>"
      enctype="<?= $config["config"]["enctype"] ?>"
      id="<?= $config["config"]["id"] ?>"
      class="<?= $config["config"]["class"] ?>">

    <?php foreach ($config["inputs"] as $name=>$configInput): ?>
      <div class="form-group">
        <?php if ($configInput["type"] != "select"): ?>
              <input
                name="<?= $name ?>"
                placeholder="<?= $configInput["placeholder"] ?? "" ?>"
                class="<?= $configInput["class"] ?? "" ?>"
                id="<?= $configInput["id"] ?? "" ?>"
                type="<?= $configInput["type"] ?? "text" ?>"
                value="<?= $configInput["value"] ?? "" ?>"
                <?php  if(isset($configInput["required"]) && $configInput["required"]==true) echo "required"; ?>
              />
        <?php else : ?>

              <select
                name="<?= $name ?>"
                placeholder="<?= $configInput["placeholder"] ?? "" ?>"
                class="<?= $configInput["class"] ?? "" ?>"
                id="<?= $configInput["id"] ?? "" ?>"
                <?php  if(isset($configInput["required"]) && $configInput["required"]==true) echo "required"; ?>
              >
              <?php foreach ($configInput["options"] as $optionId=>$optionLabel): ?>
                <option value="<?= $optionId ?>"><?= $optionLabel ?></option>
              <?php endforeach;?>

              </select>
          <?php endif; ?>

        <br><br>
      </div>
    <?php endforeach;?>

    <input type="submit" name="submit" value="<?= $config["config"]["submit"] ?>" class="form-button">
    <?php if (isset($config["config"]["reset"])): ?>
     <input type="reset" value="<?= $config["config"]["reset"] ?>" class="form-button-res">
    <?php endif; ?>

</form>