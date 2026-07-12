<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto">

<form method="post"
      action="<?= base_url('admin/vocabulary-exercises/store') ?>">

<?= csrf_field() ?>

<input
type="hidden"
name="vocabulary_id"
value="<?= $vocabulary['id'] ?>">

<div class="bg-white rounded-xl border p-8 space-y-6">

<h1 class="text-2xl font-bold">

Add Exercise

</h1>

<div>

<label class="block mb-2 font-semibold">

Question

</label>

<textarea
name="question"
rows="4"
class="w-full border rounded-lg px-4 py-3"
required><?= old('question') ?></textarea>

</div>

<div>

<label class="block mb-2 font-semibold">

Expected Answer

</label>

<textarea
name="expected_answer"
rows="3"
class="w-full border rounded-lg px-4 py-3"><?= old('expected_answer') ?></textarea>

</div>

<div>

<label class="block mb-2 font-semibold">

Difficulty

</label>

<select
name="difficulty"
class="w-full border rounded-lg px-4 py-3">

<option>Easy</option>
<option>Medium</option>
<option>Hard</option>

</select>

</div>

<div class="flex justify-end gap-3">

<a
href="<?= base_url('admin/vocabularies/exercises/'.$vocabulary['id']) ?>"
class="border px-5 py-3 rounded-lg">

Cancel

</a>

<button
class="bg-zinc-950 text-white px-5 py-3 rounded-lg">

Save Exercise

</button>

</div>

</div>

</form>

</div>

<?= $this->endSection() ?>